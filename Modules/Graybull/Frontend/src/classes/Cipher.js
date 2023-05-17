'use strict';

const CryptoJS = require('crypto-js');

export default class Cipher {

    /**
     *
     * @param data
     * @returns {string|null}
     */
    static encrypt(data) {
        if (!data) return null;

        return CryptoJS.AES
                       .encrypt(JSON.stringify(data), process.env.VUE_APP_ENCRYPTION_KEY)
                       .toString();
    }

    /**
     * Decrypt encrypted data.
     *
     * @param data
     * @return {null|any}
     */
    static decrypt(data) {
        try {
            return JSON.parse(CryptoJS.AES
                                      .decrypt(data || '', process.env.VUE_APP_ENCRYPTION_KEY)
                                      .toString(CryptoJS.enc.Utf8));
        } catch (error) {
            return null;
        }
    }
}
