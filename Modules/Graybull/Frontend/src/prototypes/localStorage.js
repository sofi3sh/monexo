'use strict';

import Cipher from '../classes/Cipher';

const STORAGE_KEY = 'GRAYBULL_GAME',
    IN_PRODUCTION = process.env.NODE_ENV === 'production';

/**
 * Get from local storage
 *
 * @param key: String|Number
 * @param defaultValue: any
 * @returns {any}
 */
const get = ({key = null} = {}, defaultValue = null) => {
    if ((key !== null) && !['undefined', 'string', 'number'].includes(typeof key)) {
        throw new Error('Parameter "key" must be string, number, null or undefined.');
    }

    let storageData = localStorage.getItem(transformStorageKey());

    try {
        storageData = JSON.parse(storageData);

        if (IN_PRODUCTION) {
            storageData = Cipher.decrypt(storageData);
        }

        if (storageData && key) {
            storageData = storageData[key];
        }

        if (!storageData && typeof storageData !== 'number') {
            storageData = defaultValue;
        }
    } catch (error) {
        storageData = defaultValue;
    }

    return storageData;
};

/**
 * Set to local storage
 *
 * @param key: String|Number
 * @param value: any
 * @param push: Boolean
 * @returns {any}
 */
const set = ({key = null, value}, {push = false} = {}) => {
    if (value === undefined) {
        value = null;
    }

    let storageData = get();

    if (push) {
        if (key) {
            if (!storageData) {
                storageData = {[key]: [value]};
            } else if (!storageData[key]) {
                if (Array.isArray(storageData)) {
                    throw new Error('Array is not an object, you cannot create array in array.');
                }

                storageData[key] = [value];
            } else {
                if (!Array.isArray(storageData[key])) {
                    throw new Error('To be pushed, the data must be an array.');
                }

                storageData[key].push(value);
            }
        } else {
            if (!storageData) {
                storageData = [value];
            } else {
                if (!Array.isArray(storageData)) {
                    throw new Error('To be pushed, the storage data must be an array.');
                }

                storageData.push(value);
            }
        }
    } else {
        if (key) {
            if (!storageData) {
                storageData = {[key]: value};
            } else if (typeof storageData !== 'object') {
                throw new Error('Storage data must be an object to set the value.');
            } else {
                storageData[key] = value;
            }
        } else {
            storageData = value;
        }
    }

    return setItem({storageData});
};

/**
 * Push to local storage
 *
 * @returns {any}
 */
const push = payload => set({...payload}, {push: true});

/**
 * Replace in local storage
 *
 * @param value: any
 */
const replace = ({value}) => {
    remove();

    return setItem({storageData: value})
};

/**
 * Remove from local storage
 */
const remove = () => {
    localStorage.removeItem(transformStorageKey())
};

/**
 * Set item to local storage
 *
 * @param storageData: any
 * @returns {any|void}
 */
const setItem = ({storageData}) => {
    try {
        localStorage.setItem(transformStorageKey(), transformStorageData(storageData));

        return storageData;
    } catch (error) {
        if ([
            'QUOTA_EXCEEDED_ERR',
            'NS_ERROR_DOM_QUOTA_REACHED',
            'QuotaExceededError',
            'W3CException_DOM_QUOTA_EXCEEDED_ERR'
        ].includes(error.name)) {
            console.error('Limit is exceeded.');
        } else {
            throw error;
        }
    }
};

/**
 * Transform storage key
 *
 * @returns {string}
 */
const transformStorageKey = () => {
    return IN_PRODUCTION
        ? STORAGE_KEY
        : 'dev_' + STORAGE_KEY;
};

/**
 * Transform storage data
 *
 * @param storageData
 * @returns {string}
 */
const transformStorageData = storageData => {
    return IN_PRODUCTION
        ? JSON.stringify(Cipher.encrypt(storageData))
        : JSON.stringify(storageData);
};

export default {
    get,
    set,
    push,
    replace,
    remove
};
