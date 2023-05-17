import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loader: {messages: []},
        userData: {},
        gameRules: {},
        activeBet: undefined,
        betPoint: undefined,
        selectedBalance: null,
        windowSize: {x: 0, y: 0}
    },
    getters: {
        loading: state => Boolean(state.loader.messages.length)
    },
    mutations: {
        SET: (state, payload) => {
            const [key, value] = Object.entries(payload)[0];

            Vue.set(state, key, value);
        }
    },
    actions: {
        makeBet({state, commit}, {direction, duration, amount}) {
            return new Promise((resolve, reject) => {
                axios.post('/graybull/game/make-bet', {
                         direction,
                         duration,
                         amount,
                         balance: state.selectedBalance
                     })
                     .then(({data}) => {
                         commit('SET', {activeBet: data.bet});
                         commit('SET', {userData: data.user_data});

                         resolve(data.bet_point);
                     })
                     .catch(error => reject(error));
            });
        },
        closeBet({state, commit}) {
            return new Promise(resolve => {
                axios.post('/graybull/game/close-active-bet', {bet_id: state.activeBet.id})
                     .then(({data}) => {
                         commit('SET', {activeBet: undefined});
                         commit('SET', {userData: data.user_data});

                         const betPayment = data.bet_payment;

                         if (betPayment.type === 'winning') {
                             resolve({winningAmount: betPayment.amount_usd});
                         } else {
                             resolve({cashbackAmount: betPayment.amount_usd});
                         }
                     });
            });
        },
        load({dispatch}, {callback = Function, message = null}) {

            /* eslint-disable-next-line */
            return new Promise(async resolve => {
                if (!message) {
                    return resolve(await callback());
                }

                await dispatch('addMessageToLoader', message);

                resolve(await callback());

                dispatch('removeMessageFromLoader', message);
            });
        },
        addMessageToLoader({state}, message) {
            if (state.loader.messages.indexOf(_message => _message === message)) {
                state.loader.messages.push(message);
            }
        },
        removeMessageFromLoader({state}, message) {
            state.loader.messages = state.loader.messages.filter(_message => _message !== message);
        }
    }
})
