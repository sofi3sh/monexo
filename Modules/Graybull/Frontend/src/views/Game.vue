<template>
    <div :id="$style.container">
        <GameChart v-if="showChart"
                   :show-toolbar="showChartToolbar"/>

        <GameControlPanel v-if="showControlPanel"/>

        <WinningScene v-if="winningAmount"
                      :amount="winningAmount"
                      @hide="winningAmount = undefined"/>

        <CashbackScene v-if="cashbackAmount"
                       :amount="cashbackAmount"
                       @hide="cashbackAmount = undefined"/>
    </div>
</template>

<script>
    import GameControlPanel from '@/components/GameControlPanel';
    import GameChart from '@/components/GameChart';
    import axios from 'axios';

    export default {
        name: 'Game',
        components: {
            GameControlPanel,
            GameChart,
            WinningScene: () => import('@/components/WinningScene'),
            CashbackScene: () => import('@/components/CashbackScene')
        },
        data: () => ({
            winningAmount: undefined,
            cashbackAmount: undefined,
            showChart: false,
            showControlPanel: false
        }),
        computed: {
            windowSize() {
                return this.$store.state.windowSize;
            },
            showChartToolbar() {
                return this.chartData && this.windowSize.x > 1100;
            },
            activeBet: {
                get() {
                    return this.$store.state.activeBet;
                },
                set(activeBet) {
                    return this.$store.commit('SET', {activeBet});
                }
            },
            chartData: {
                get() {
                    return this.$store.state.chartData;
                },
                set(chartData) {
                    return this.$store.commit('SET', {chartData});
                }
            }
        },
        methods: {
            async getActiveBet() {
                const loaderMessage = this.$t('loader-messages.getting-active-bet');

                await this.$store.dispatch('addMessageToLoader', loaderMessage);

                const {data: activeBet} = await axios.get('/graybull/game/get-active-bet');

                if (Object.entries(activeBet).length) {
                    this.activeBet = activeBet;

                    const betPoint = this.$localStorage.get({key: 'betPoint'}) || undefined;

                    this.$store.commit('SET', {betPoint});

                    this.startTimerToCloseActiveBet();
                }

                await this.$store.dispatch('removeMessageFromLoader', loaderMessage);

                this.showControlPanel = true;
            },
            updateChartData() {
                axios.get('/graybull/game/get-chart-data')
                     .then(({data}) => (this.chartData = data));
            },
            startTimerToCloseActiveBet() {
                setTimeout(async () => {
                    const loaderMessage = this.$t('loader-messages.closing-bet');

                    await this.$store.dispatch('addMessageToLoader', loaderMessage);

                    const {
                        winningAmount = undefined,
                        cashbackAmount = undefined
                    } = await this.$store.dispatch('closeBet');

                    if (winningAmount) {
                        this.winningAmount = winningAmount;
                    } else if (cashbackAmount) {
                        this.cashbackAmount = cashbackAmount;
                    }

                    await this.$nextTick();

                    this.$store.commit('SET', {betPoint: undefined});

                    await this.$store.dispatch('removeMessageFromLoader', loaderMessage);

                    this.$bus.$emit('bet-closed');
                }, this.activeBet.remaining_seconds * 1000);
            }
        },
        created() {
            this.getActiveBet();
            this.updateChartData();

            this.showChart = true;

            setInterval(this.updateChartData, 1000 * 10);

            this.$bus.$on('bet-placed', this.startTimerToCloseActiveBet);
        },
        beforeDestroy() {
            this.$bus.$off('bet-placed');
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    #container
        overflow: hidden
        display: flex
        flex-wrap: nowrap
        justify-content: space-between

        @media screen and (max-width: 850px)
            justify-content: center
            flex-wrap: wrap
</style>
