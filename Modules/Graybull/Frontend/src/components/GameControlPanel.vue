<template>
    <div :class="$style.container">
        <transition :css="false"
                    appear
                    @enter="contentEnterAnimation">
            <div :class="$style.content">
                <div :class="$style.card">
                    <transition :css="false"
                                @enter="contentEnterAnimation">
                        <strong v-if="activeBet"
                                style="text-align: center; margin-top: -5px; margin-bottom: 5px;"
                                v-t="'bet-active'"></strong>
                    </transition>

                    <div class="app-input-group-container"
                         style="margin-bottom: 6px;">
                        <label v-t="'period'"></label>

                        <div :class="['app-input-group', $style['input-group']]">
                            <i class="material-icons md-28"
                               v-text="'chevron_left'"
                               @click="switchDuration(-1)"></i>

                            <AppSelect v-model.number="selectedDuration"
                                       :disabled="!interactionAllowed"
                                       :options="gameRules.duration_options || []"
                                       hide-arrow
                                       style="width: 60px;">
                                <template #selected-option="{option}">
                                    <span style="font-size: 24px;"
                                          v-text="durationSelectOptions[option]"></span>
                                </template>

                                <template #option="{option}">
                                    <span style="font-size: 24px;"
                                          v-text="durationSelectOptions[option]"></span>
                                </template>
                            </AppSelect>

                            <i class="material-icons md-28"
                               v-text="'chevron_right'"
                               @click="switchDuration(+1)"></i>
                        </div>

                        <transition :css="false"
                                    @enter="contentItemsEnterAnimation"
                                    @leave="contentItemsLeaveAnimation">
                            <strong v-if="timer.remainingTime"
                                    style="margin-left: 5px;"
                                    v-text="timer.remainingTime"></strong>
                        </transition>
                    </div>

                    <div class="app-input-group-container"
                         style="margin-bottom: 5px;">
                        <span v-t="'sum'"></span>

                        <div :class="['app-input-group', $style['input-group']]"
                             style="margin-left: 12px;">
                            <i class="material-icons md-28"
                               v-text="'chevron_left'"
                               @click="interactionAllowed && amountDecrement()"></i>
                            <amountInput v-model="amountInput"
                                         :min="minAmount"
                                         :max="maxAmount"
                                         :disabled="!interactionAllowed"
                                         :precision="0"
                                         prefix="$"
                                         placeholder="USD"
                                         style="width: 60px; font-size: 22px;"/>

                            <i class="material-icons md-28"
                               v-text="'chevron_right'"
                               @click="interactionAllowed && amountIncrement()"></i>
                        </div>


                        <transition :css="false"
                                    @enter="contentItemsEnterAnimation"
                                    @leave="contentItemsLeaveAnimation">
                            <strong v-if="activeBet && timer.remainingTime"
                                    style="margin-left: 5px;">
                                <span>$</span>{{ activeBet.winnings_amount }}
                            </strong>
                        </transition>
                    </div>

                    <div :id="$style['selected-balance']"
                         :style="selectedBalanceStyle"
                         v-text="selectedBalance"></div>

                    <transition :css="false"
                                @enter="collapseEnterAnimation"
                                @leave="collapseLeaveAnimation">
                        <div v-if="equivalentAmountInCurrency"
                             :class="$style.hint">
                            <div>
                                {{ amountInput }} USD
                            </div>

                            <strong style="margin: -4px 5px 0; font-size: 16px;">≈</strong>

                            <div>
                                {{ equivalentAmountInCurrency }}

                                <span style="text-transform: uppercase;"
                                      v-text="selectedBalance"></span>
                            </div>
                        </div>
                    </transition>

                    <transitionGroup :css="false"
                                     tag="div"
                                     @enter="collapseEnterAnimation"
                                     @leave="collapseLeaveAnimation">
                        <div :key="'available-amount'"
                             v-if="maxAmount || maxAmount === 0"
                             :class="$style.hint">
                            <span style="margin-right: 4px;"
                                  v-t="'available-amount'"></span>

                            <span>
                                ${{ maxAmount }}
                            </span>
                        </div>

                        <div :key="'possible-winning-amount'"
                             v-if="maxAmount"
                             :class="$style.hint">
                            <span style="margin-right: 4px;"
                                  v-t="'possible-winning-amount'"></span>

                            <span>
                                ${{ possibleWinningAmount }}
                            </span>
                        </div>

                        <div :key="'possible-cashback-amount'"
                             v-if="maxAmount"
                             :class="$style.hint">
                            <span style="margin-right: 4px;"
                                  v-t="'possible-cashback-amount'"></span>

                            <span>
                                ${{ possibleCashbackAmount }}
                            </span>
                        </div>
                    </transitionGroup>
                </div>

                <div :css="false"
                     :class="$style.card"
                     style="white-space: nowrap;">
                    <div :key="'rate'"
                         v-if="!activeBet">
                        {{ $t('current-btc-rate') }} <strong>${{ currentExchangeRate }}</strong>
                    </div>

                    <div :key="'details'"
                         v-else>
                        <div>
                            {{ $t('rate-at-opening') }} <strong>${{ activeBet.exchange_rate_at_opening }}</strong>
                        </div>

                        <div style="white-space: nowrap;">
                            <span>
                                {{ $t('current-btc-rate') }} <strong>${{ currentExchangeRate }}</strong>
                            </span>

                            <strong v-html="exchangeRateDifferenceHtml"></strong>
                        </div>

                        <div>
                            {{ $t('win-threshold') }} <strong>${{ winThresholdValueText }}</strong>
                        </div>

                        <div>
                            <span v-t="'bet-direction'"></span>

                            <strong :style="{
                                        marginLeft: '5px',
                                        textTransform: 'uppercase',
                                        color: activeBet.direction === 'up' ? 'var(--color-green)': 'var(--color-red)'
                                    }"
                                    v-t="activeBet.direction"></strong>
                        </div>
                    </div>

                    <div :key="'balance'"
                         v-if="selectedBalanceAmount">
                        {{ $t('your-balance') }}

                        <strong>
                            {{ selectedBalanceAmount }}

                            <span style="text-transform: uppercase;"
                                  v-text="selectedBalance"></span>
                        </strong>
                    </div>

                    <div :key="'win-text'"
                         v-if="activeBet && betWins"
                         style="margin-bottom: -5px; text-align: center; color: var(--color-green);">
                        <strong v-t="'you-win'"></strong>
                    </div>
                </div>

                <transition :css="false"
                            appear
                            @enter="contentItemsEnterAnimation"
                            @leave="contentItemsLeaveAnimation">
                    <div v-if="!activeBet"
                         :class="$style['action-buttons']">
                        <button type="button"
                                :disabled="!interactionAllowed"
                                v-t="'up'"
                                @click="makeBet('up')"></button>

                        <button type="button"
                                :disabled="!interactionAllowed"
                                v-t="'down'"
                                @click="makeBet('down')"></button>
                    </div>
                </transition>

                <div id="game-control-panel--game-rules"
                     :class="$style['game-rules-hint']"
                     @click="showRules = true">
                    <span v-html="$t('game-rules-hint')"></span>
                </div>
            </div>
        </transition>

        <ModalWindow v-model="showRules"
                     :title="$t('game-rules')">
            <div style="padding: 10px 20px; font-size: 14px;">
                <span v-html="$t('rules-text')"></span>
            </div>
        </ModalWindow>
    </div>
</template>

<script>
    import AppSelect from '@/components/AppSelect';
    import AmountInput from '@/components/AmountInput';
    import ModalWindow from '@/components/ModalWindow';
    import Swal from 'sweetalert2/dist/sweetalert2.js';
    import axios from 'axios';
    import {gsap} from 'gsap';

    export default {
        name: 'GameControlPanel',
        components: {
            AppSelect,
            AmountInput,
            ModalWindow
        },
        data: () => ({
            currencyQuotes: {
                btc: undefined,
                eth: undefined,
                pzm: undefined
            },
            amountInput: null,
            selectedDuration: {},
            showRules: false,
            timer: {
                id: undefined,
                remainingTime: 0
            }
        }),
        computed: {
            interactionAllowed() {
                return !this.$store.state.activeBet && !this.$store.getters.loading;
            },
            currentExchangeRate() {
                return this.$store.state.chartData
                    ? this.$store.state.chartData[this.$store.state.chartData.length - 1][4]
                    : null;
            },
            possibleWinningAmount() {
                return (this.amountInput + ((this.amountInput / 100) * this.gameRules.winning_percentage)).toFixed(2);
            },
            possibleCashbackAmount() {
                return ((this.amountInput / 100) * this.gameRules.cashback_percentage).toFixed(2);
            },
            windowSize() {
                return this.$store.state.windowSize;
            },
            selectedBalance() {
                return this.$store.state.selectedBalance;
            },
            selectedBalanceAmount() {
                return this.userData['balance_' + this.selectedBalance];
            },
            selectedBalanceStyle() {
                return {
                    usd: {backgroundColor: '#175aa7', borderColor: '#175aa7'},
                    btc: {backgroundColor: '#d07935', borderColor: '#d07935'},
                    eth: {backgroundColor: '#1b9438', borderColor: '#1b9438'},
                    pzm: {backgroundColor: '#6b3f98', borderColor: '#6b3f98'}
                }[this.selectedBalance];
            },
            equivalentAmountInCurrency() {
                if (!this.currencyQuotes[this.selectedBalance]) {
                    return null;
                }

                return (this.amountInput / this.currencyQuotes[this.selectedBalance]).toFixed(8);
            },
            equivalentCurrencyBalanceInUsd() {
                if (!this.currencyQuotes[this.selectedBalance]) {
                    return null;
                }

                return this.selectedBalanceAmount * this.currencyQuotes[this.selectedBalance];
            },
            selectedPeriodIndex() {
                return Object.keys(this.durationSelectOptions)
                             .findIndex(option => Number(option) === this.selectedDuration);
            },
            durationSelectOptions() {
                const options = {};

                for (const optionValue of this.gameRules.duration_options || []) {
                    options[optionValue] = new Date(optionValue * 1000 * 60).toISOString().substr(14, 5);
                }

                return options;
            },
            exchangeRateDifferenceHtml() {
                if (!this.activeBet) {
                    return null;
                }

                const rateDifference = this.currentExchangeRate - this.activeBet.exchange_rate_at_opening,
                    mathSymbol = rateDifference === 0 ? '' : (this.currentExchangeRate > this.activeBet.exchange_rate_at_opening ? '+' : '-');

                return `<span style="margin-left: 4px; color: var(--color-${rateDifference > 0 ? 'green' : 'red'})">${mathSymbol}${Math.abs(rateDifference).toFixed(2)}</span>`;
            },
            minAmount() {
                return parseInt(this.gameRules.min_amount)
            },
            maxAmount() {
                const amountInUsd = typeof this.equivalentCurrencyBalanceInUsd === 'number'
                    ? this.equivalentCurrencyBalanceInUsd
                    : this.userData.balance_usd;

                return parseInt(amountInUsd > this.gameRules.max_amount
                    ? this.gameRules.max_amount
                    : amountInUsd);
            },
            betWins() {
                if (!this.activeBet) {
                    return false;
                }

                const direction = this.activeBet.direction,
                    rateDifference = this.currentExchangeRate - this.activeBet.exchange_rate_at_opening,
                    minRateDiff = this.gameRules.min_rate_diff_to_win;

                return (direction === 'up' && rateDifference >= minRateDiff)
                    || (direction === 'down' && rateDifference <= -minRateDiff);
            },
            winThresholdValueText() {
                if (!this.activeBet) {
                    return null;
                }

                return this.activeBet.direction === 'up'
                    ? this.activeBet.exchange_rate_at_opening + this.gameRules.min_rate_diff_to_win
                    : this.activeBet.exchange_rate_at_opening - this.gameRules.min_rate_diff_to_win;
            },
            gameRules() {
                return this.$store.state.gameRules;
            },
            userData() {
                return this.$store.state.userData;
            },
            activeBet: {
                get() {
                    return this.$store.state.activeBet;
                },
                set(activeBet) {
                    return this.$store.commit('SET', {activeBet});
                }
            }
        },
        watch: {
            selectedBalance(newValue) {
                this.amountInput = this.maxAmount ? 1 : 0;

                this.updateCurrencyQuote(newValue);
            }
        },
        methods: {
            switchDuration(operand) {
                if (!this.interactionAllowed) {
                    return;
                }

                const durationSelectOptionsArray = Object.keys(this.durationSelectOptions),
                    durationSelectOptionsArrayLength = durationSelectOptionsArray.length;

                if (operand > 0) {
                    if ((this.selectedPeriodIndex + 1) < durationSelectOptionsArrayLength) {
                        this.selectedDuration = parseInt(durationSelectOptionsArray[this.selectedPeriodIndex + 1]);
                    }
                } else {
                    if (this.selectedPeriodIndex > 0) {
                        this.selectedDuration = parseInt(durationSelectOptionsArray[this.selectedPeriodIndex - 1]);
                    }
                }
            },
            amountIncrement() {
                const amount = this.amountInput + 1;

                if (amount <= this.maxAmount) {
                    this.amountInput = amount;
                }
            },
            amountDecrement() {
                const amount = this.amountInput - 1;

                if (amount >= this.minAmount) {
                    this.amountInput = amount;
                }
            },
            startRemainingTimeTimer() {
                this.timer.id = setInterval(this.updateRemainingTime, 1000);
            },
            stopRemainingTimeTimer() {
                clearInterval(this.timer.id);

                this.timer.id = undefined;

                this.timer.remainingTime = 0;
            },
            updateRemainingTime() {
                if (!this.activeBet) {
                    this.stopRemainingTimeTimer();

                    return;
                }

                this.activeBet.remaining_seconds--;

                const remainingSeconds = this.activeBet.remaining_seconds;

                if (remainingSeconds > 0) {
                    this.timer.remainingTime = new Date(Math.abs(remainingSeconds) * 1000)
                        .toISOString()
                        .substr(14, 5);

                    return;
                }

                this.stopRemainingTimeTimer();
            },
            async updateCurrencyQuote(code) {
                if (code === 'usd') {
                    return;
                }

                if (!this.currencyQuotes[code]) {
                    const {data: currencyQuotes} = await this.$store.dispatch('load', {
                        callback: () => axios.get('/graybull/game/get-exchange-rate', {params: {codes: [code]}}),
                        message: this.$t('loader-messages.updating-currency-quote')
                    });

                    this.currencyQuotes[code] = currencyQuotes[code];
                }
            },
            resetInputs() {
                this.selectedDuration = this.gameRules.duration_options[0];
                this.amountInput = this.gameRules.min_amount;
            },
            async makeBet(direction) {
                if (!direction
                    || !this.amountInput
                    || !this.interactionAllowed
                    || this.amountInUsd > this.userData.balance_usd) {
                    return;
                }

                const commission = this.gameRules.bet_opening_commission,
                    minRateDiffToWin = this.gameRules.min_rate_diff_to_win;

                Swal.fire({
                    title: this.$t('bet-opening'),
                    html: `<div style="display: flex; justify-content: center;">
                                <div style="display: flex; flex-direction: column; text-align: left;">
                                    <div>${this.$t('period')} <strong>${this.durationSelectOptions[this.selectedDuration]}</strong></div>
                                    <div>${this.$t('sum')} <strong>$${this.amountInput}</strong></div>
                                    <div>${this.$t('balance')} <strong>${this.selectedBalance.toUpperCase()}</strong></div>
                                    <div>${this.$t('direction')} <strong style="text-transform: uppercase;">${this.$t(direction)}</strong></div>
                                    <div>${this.$t('current-btc-rate')} <strong style="text-transform: uppercase;">$${this.currentExchangeRate}</strong></div>
                                </div>
                            </div>`,
                    footer: '<small>' + this.$t('bet-opening-hint', {commission, minRateDiffToWin}) + '</small>',
                    confirmButtonText: this.$t('confirm'),
                    confirmButtonColor: 'var(--color-green)',
                    cancelButtonColor: 'var(--color-red)',
                    showConfirmButton: true,
                    cancelButtonText: this.$t('close'),
                    showCancelButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    preConfirm: async () => {
                        Swal.fire({
                            text: this.$t('bet-opening'),
                            timer: 0,
                            timerProgressBar: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onBeforeOpen: () => Swal.showLoading()
                        });

                        const loaderMessage = this.$t('loader-messages.making-bet');

                        await this.$store.dispatch('addMessageToLoader', loaderMessage);

                        let betPoint;

                        try {
                            betPoint = await this.$store.dispatch('makeBet', {
                                direction,
                                duration: this.selectedDuration,
                                amount: this.amountInput
                            });
                        } catch ({response}) {
                            Swal.fire({
                                title: this.$t('bet-opening'),
                                text: response.data,
                                icon: 'error'
                            });

                            await this.$store.dispatch('removeMessageFromLoader', loaderMessage);

                            return;
                        }

                        this.$store.commit('SET', {betPoint});

                        this.$localStorage.set({key: 'betPoint', value: betPoint});

                        await this.$nextTick();

                        Swal.fire({
                            title: this.$t('bet-opening'),
                            text: this.$t('success'),
                            icon: 'success'
                        });

                        setTimeout(() => {
                            if (Swal.isVisible()) {
                                Swal.close();
                            }
                        }, 20 * 1000);

                        await this.$store.dispatch('removeMessageFromLoader', loaderMessage);

                        this.$bus.$emit('bet-placed');

                        this.startRemainingTimeTimer();
                    }
                });
            },
            async startUpdatingExchangeRate() {
                if (this.equivalentCurrencyBalanceInUsd) {
                    const params = {
                        codes: [this.selectedBalance]
                    };

                    const rates = (await axios.get('/graybull/game/get-exchange-rate', {params})).data;

                    for (const code in rates) {

                        /* eslint-disable-next-line */
                        if (rates.hasOwnProperty(code)) {
                            this.currencyQuotes[code] = rates[code];
                        }
                    }
                }

                setTimeout(this.startUpdatingExchangeRate, 1000 * 10);
            },
            contentEnterAnimation(el, done) {
                document.body.style.overflow = 'hidden';

                let fromVarsSupplement,
                    toVarsSupplement;

                if (window.innerWidth > 1000) {
                    fromVarsSupplement = {xPercent: 50};
                    toVarsSupplement = {xPercent: 0};
                } else {
                    fromVarsSupplement = {yPercent: 10};
                    toVarsSupplement = {yPercent: 0};
                }

                gsap.fromTo(el, {
                    autoAlpha: 0,
                    ...fromVarsSupplement
                }, {
                    delay: 0.35,
                    duration: 0.8,
                    autoAlpha: 1,
                    ...toVarsSupplement,
                    ease: 'elastic.out(0.8, 0.5)',
                    onComplete() {
                        document.body.style.overflow = null;

                        done();
                    }
                });
            },
            contentItemsEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    scale: 0
                }, {
                    duration: 0.5,
                    autoAlpha: 1,
                    scale: 1,
                    onComplete: done
                });
            },
            contentItemsLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.25,
                    autoAlpha: 0,
                    scale: 0,
                    onComplete: done
                });
            },
            collapseEnterAnimation(el, done) {
                const height = el.clientHeight,
                    margin = el.style.margin;

                el.style.overflow = 'hidden';
                el.style.margin = 0;

                gsap.fromTo(el, {
                    autoAlpha: 0,
                    height: 0,
                    margin: 0
                }, {
                    duration: 0.3,
                    autoAlpha: 1,
                    height,
                    margin,
                    onComplete() {
                        el.style.height = null;

                        done();
                    }
                });
            },
            collapseLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.2,
                    autoAlpha: 0,
                    height: 0,
                    margin: 0,
                    onComplete: done
                });
            }
        },
        created() {
            if (this.activeBet) {
                this.selectedDuration = this.activeBet.duration_in_minutes;
                this.amountInput = this.activeBet.amount_usd;

                this.startRemainingTimeTimer();
            } else {
                this.resetInputs();
            }

            this.startUpdatingExchangeRate();

            this.$bus.$on('bet-closed', this.resetInputs);
        },
        beforeDestroy() {
            this.$bus.$off('bet-closed');
        }
    }
</script>

<style lang="scss">
    @import '~@sweetalert2/theme-borderless/borderless.scss';

    .swal2-container.swal2-backdrop-show,
    .swal2-container.swal2-noanimation {
        background-color: var(--backdrop-color);
    }

    @media screen and (max-width: 450px) {
        .swal2-actions > button {
            width: 100%;
        }
    }

    @media screen and (max-width: 850px) {
        #game-control-panel--game-rules {
            > span {
                white-space: nowrap;

                br {
                    display: none;
                }
            }
        }
    }
</style>

<style lang="sass"
       module
       scoped>
    .container
        margin: 40px 30px

        @media screen and (max-width: 1520px)
            margin: 15px 30px

        @media screen and (max-width: 850px)
            margin-top: 5px

            .content
                flex-direction: row
                flex-wrap: wrap
                justify-content: center
                background-color: transparent
                font-size: 14px

                > div:last-child,
                .action-buttons
                    width: 100%

                .action-buttons
                    flex-direction: row !important
                    justify-content: center

                    > button
                        font-size: 20px !important

                .card
                    padding: 5px 20px !important

                    &:first-of-type
                        padding-top: 10px !important

                    .input-group
                        > i
                            font-size: 24px

                        span
                            font-size: 20px !important

                        input
                            font-size: 16px !important

        .content
            display: flex
            flex-direction: column

            @media screen and (max-width: 550px)
                flex-direction: row
                flex-wrap: wrap
                justify-content: center
                align-items: flex-start

            .action-buttons
                display: flex
                flex-direction: column

                > button
                    appearance: none
                    overflow: hidden
                    position: relative
                    vertical-align: middle
                    outline: none
                    margin: 5px
                    padding: 10px
                    font-size: 24px
                    line-height: 1
                    letter-spacing: 0.5px
                    text-transform: uppercase
                    font-weight: 500
                    color: #fff
                    border: none
                    user-select: none
                    cursor: pointer
                    border-radius: 5px
                    transition: background-size 120ms ease-in-out, background-position 120ms ease-in-out, box-shadow 120ms ease-in-out
                    will-change: background-size, background-position, box-shadow

                    &:first-of-type
                        background-image: linear-gradient(to right, #0ba360, #3cba92, #30dd8a, #2bb673)
                        box-shadow: 0 4px 15px 0 rgba(23, 168, 108, 0.25)

                        &:hover
                            box-shadow: 0 4px 15px 0 rgba(23, 168, 108, 0.75)

                    &:last-of-type
                        background-image: linear-gradient(to right, #eb3941, #f15e64, #e14e53, #e2373f)
                        box-shadow: 0 5px 15px rgba(242, 97, 103, 0.2)

                        &:hover
                            box-shadow: 0 5px 15px rgba(242, 97, 103, 0.4)

            .card
                position: relative
                display: flex
                flex-direction: column
                min-width: 200px
                margin: 5px
                padding: 10px 20px
                background-color: var(--color-cloudy)
                border-radius: var(--default-border-radius)
                box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.08), 0 4px 5px 0 rgba(0, 0, 0, 0.08), 0 1px 10px 0 rgba(0, 0, 0, 0.02)
                user-select: none

                #selected-balance
                    position: absolute
                    bottom: 5px
                    left: -20px
                    padding: 2px 4px
                    text-transform: uppercase
                    font-size: 14px
                    font-weight: 500
                    background-color: var(--color-cloudy-light)
                    border: 2px ridge transparent
                    border-radius: var(--default-border-radius)
                    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.08), 0 4px 5px 0 rgba(0, 0, 0, 0.08), 0 1px 10px 0 rgba(0, 0, 0, 0.02)
                    user-select: none

                .hint
                    white-space: nowrap
                    display: flex
                    margin: 3px 8px -2px 8px
                    font-size: 12px

                .input-group
                    > i
                        cursor: pointer
                        transition: transform 120ms ease-in-out
                        will-change: transform

                        &:hover:not(:active)
                            transform: scale(1.1)

        .game-rules-hint
            margin-top: 5px
            text-align: center
</style>
