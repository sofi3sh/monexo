<template>
    <ViewPage>
        <template #title>
            {{ $t('history') }}
        </template>

        <div :class="$style.tabs">
            <a v-t="'bets'"
               :class="{[$style.active]: activeTab === 'bets'}"
               @click.prevent="activeTab = 'bets'"></a>

            <a v-t="'bonuses'"
               :class="{[$style.active]: activeTab === 'bonuses'}"
               @click.prevent="activeTab = 'bonuses'"></a>
        </div>

        <transition :css="false"
                    mode="out-in"
                    @enter="tabEnterAnimation"
                    @leave="tabLeaveAnimation">
            <div v-if="activeTab === 'bets'"
                 :key="'bets'"
                 class="app-table">
                <table>
                    <thead>
                        <tr>
                            <th v-t="'tool'"></th>
                            <th v-t="'bet'"></th>
                            <th>{{ $t('sum') }} USD</th>
                            <th>{{ $t('sum') }} BTC</th>
                            <th>{{ $t('sum') }} ETH</th>
                            <th>{{ $t('sum') }} PZM</th>
                            <th v-t="'result'"></th>
                            <th v-t="'date'"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="bet in betHistory.data"
                            :key="bet.id">
                            <td>BTC/USD</td>

                            <td>
                                {{ bet.exchange_rate_at_opening }} / {{ bet.exchange_rate_at_closing }}
                            </td>

                            <td>{{ parseFloat(bet.amount_usd) }}</td>
                            <td>{{ parseFloat(bet.amount_btc) }}</td>
                            <td>{{ parseFloat(bet.amount_eth) }}</td>
                            <td>{{ parseFloat(bet.amount_pzm) }}</td>

                            <td v-if="!bet.payment">-</td>

                            <td v-else-if="bet.status === 'win'"
                                style="color: var(--color-green);">
                                <img src="@/assets/img/course_up.svg"
                                     alt=""
                                     style="margin-right: 2px;">

                                ${{ bet.payment.amount_usd }}
                            </td>

                            <td v-else
                                style="color: var(--color-red);">
                                <img src="@/assets/img/course_down.svg"
                                     alt=""
                                     style="margin-right: 2px;">

                                ${{ bet.payment.amount_usd }}
                            </td>

                            <td>{{ bet.closed_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-else
                 :key="'bonuses'"
                 class="app-table">
                <table>
                    <thead>
                        <tr>
                            <th v-t="'partner'"></th>
                            <th v-t="'bonus'"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="bonus in bonusHistory.data"
                            :key="bonus.id">
                            <td>{{ bonus.email }}</td>
                            <td class="color-green">${{ bonus.amount_usd }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </transition>

        <transition :css="false"
                    mode="out-in"
                    @enter="tabEnterAnimation"
                    @leave="tabLeaveAnimation">
            <pagination v-if="activeTab === 'bets'"
                        :data="betHistory"
                        :limit="2"
                        @pagination-change-page="getBetHistory">
                <span slot="prev-nav">
                    <i class="material-icons">arrow_back_ios</i>
                </span>

                <span slot="next-nav">
                    <i class="material-icons">arrow_forward_ios</i>
                </span>
            </pagination>

            <pagination v-else
                        :data="bonusHistory"
                        :limit="2"
                        @pagination-change-page="getBonusHistory">
                <span slot="prev-nav">
                    <i class="material-icons">arrow_back_ios</i>
                </span>

                <span slot="next-nav">
                    <i class="material-icons">arrow_forward_ios</i>
                </span>
            </pagination>
        </transition>
    </ViewPage>
</template>

<script>
    import ViewPage from '@/components/ViewPage';
    import Pagination from 'laravel-vue-pagination';
    import axios from 'axios';
    import {gsap} from "gsap";

    export default {
        name: 'History',
        components: {
            ViewPage,
            Pagination
        },
        data: () => ({
            activeTab: 'bets',
            betHistory: {},
            bonusHistory: {},
            needToUpdateBetHistory: true,
            needToUpdateBonusHistory: true
        }),
        watch: {
            activeTab() {
                this.$nextTick(this.loadData);
            }
        },
        methods: {
            async getBetHistory(page = undefined) {
                const loaderMessage = this.$t('loader-messages.getting-bet-history');

                await this.$store.dispatch('addMessageToLoader', loaderMessage);

                this.needToUpdateBetHistory = false;

                if (!page) {
                    page = (this.betHistory['current_page'] || 0) + 1;
                }

                this.betHistory = (await axios.get('/graybull/game/get-bet-history', {params: {page}})).data;

                await this.$store.dispatch('removeMessageFromLoader', loaderMessage);
            },
            async getBonusHistory(page = undefined) {
                this.needToUpdateBonusHistory = false;

                const loaderMessage = this.$t('loader-messages.getting-bonus-history');

                await this.$store.dispatch('addMessageToLoader', loaderMessage);

                if (!page) {
                    page = (this.bonusHistory['current_page'] || 0) + 1;
                }

                this.bonusHistory = (await axios.get('/graybull/game/get-bonus-history', {params: {page}})).data;

                await this.$store.dispatch('removeMessageFromLoader', loaderMessage);
            },
            loadData() {
                switch (this.activeTab) {
                    case 'bets':
                        this.needToUpdateBetHistory && this.getBetHistory();
                        break;
                    case 'bonuses':
                        this.needToUpdateBonusHistory && this.getBonusHistory();
                        break;
                    default:
                        throw new Error(`Unexpected tab name: ${this.activeTab}`);
                }
            },
            resetData() {
                this.needToUpdateBetHistory = true;
                this.needToUpdateBonusHistory = true;

                this.betHistory['current_page'] = undefined;
                this.bonusHistory['current_page'] = undefined;
            },
            tabEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0
                }, {
                    duration: 0.2,
                    autoAlpha: 1,
                    onComplete: done
                });
            },
            tabLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.1,
                    autoAlpha: 0,
                    onComplete: done
                });
            }
        },
        async created() {
            this.$bus.$on(['bet-placed', 'bet-closed'], () => {
                this.resetData();

                if (!this._inactive) {
                    this.loadData();
                }
            });
        },
        activated() {
            this.loadData();
        },
        beforeDestroy() {
            this.$bus.$off(['bet-placed', 'bet-closed']);
        }
    }
</script>

<style lang="sass">
    .pagination
        display: flex
        align-self: center
        margin: 15px 10px
        padding: 0
        list-style: none

        li
            background-color: var(--color-cloudy)
            cursor: pointer
            transition: background-color 120ms
            will-change: background-color

            &:first-of-type
                border-radius: 5px 0 0 5px

            &:last-of-type
                border-radius: 0 5px 5px 0

            &.active,
            &:hover:not(:active)
                background-color: var(--color-cloudy-light)

                > a
                    color: var(--color-primary)

            > a
                display: inline-flex
                align-items: center
                justify-content: center
                min-width: 30px
                padding: 4px
                text-align: center
                font-weight: 500
                color: #fff
                transition: color 120ms ease
                will-change: color

                i
                    font-size: 16px
                    margin-top: 2px

            .sr-only
                display: none
</style>

<style lang="sass"
       module
       scoped>
    .tabs
        display: flex
        margin-bottom: 20px
        font-size: 18px

        > a
            &.active
                color: var(--color-cloudy-light)

            &:not(:last-of-type)
                margin-right: 8px
</style>
