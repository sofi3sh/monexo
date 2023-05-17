<template>
    <ViewPage>
        <template #title>
            {{ $t('statistic') }}
        </template>

        <div class="app-table">
            <table>
                <tbody>
                    <tr v-for="{name, value, bold = false} in rows"
                        :key="name"
                        :class="{[$style.bold]: bold}">
                        <td v-text="$t(name)"></td>
                        <td v-text="gameStatistics[value]"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </ViewPage>
</template>

<script>
    import ViewPage from '@/components/ViewPage';
    import axios from 'axios';

    export default {
        name: 'Statistic',
        components: {ViewPage},
        data: () => ({
            gameStatistics: [],
            needToUpdateGameStatistics: false,
            rows: [
                {name: 'number-of-bets', value: 'number_of_games'},
                {name: 'number-of-successful-bets', value: 'number_of_winning_games'},
                {name: 'number-of-failed-bets', value: 'number_of_losing_games'},
                {name: 'total-amount-of-bets', value: 'total_amount'},
                {name: 'total-earnings-from-bets', value: 'total_winnings'},
                {name: 'partner-bets', value: 'number_of_partner_deals'},
                {name: 'earnings-from-partners', value: 'earnings_from_partners'},
                {name: 'time-in-game', value: 'time_in_game'},
                {name: 'total-earnings', value: 'total_earnings', bold: true}
            ]
        }),
        methods: {
            async getGameStatistics() {
                this.needToUpdateGameStatistics = false;

                const {data: gameStatistics} = await this.$store.dispatch('load', {
                    callback: () => axios.get('/graybull/game/get-game-statistics'),
                    message: this.$t('loader-messages.getting-game-statistics')
                });

                this.gameStatistics = gameStatistics;
            }
        },
        async created() {
            await this.getGameStatistics();

            this.$bus.$on(['bet-placed', 'bet-closed'], () => {
                if (this._inactive) {
                    this.needToUpdateGameStatistics = true;
                } else {
                    this.getGameStatistics();
                }
            });
        },
        activated() {
            if (this.needToUpdateGameStatistics) {
                this.getGameStatistics();
            }
        },
        beforeDestroy() {
            this.$bus.$off(['bet-placed', 'bet-closed']);
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    .bold
        font-weight: 500
</style>
