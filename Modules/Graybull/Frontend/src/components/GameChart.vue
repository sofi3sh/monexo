<template>
    <transition :css="false"
                appear
                @enter="gameChartEnterAnimation">
        <tradingVue ref="chart"
                    :data="chart"
                    title-txt="BTC/USD"
                    :width="width"
                    :height="height"
                    :toolbar="showToolbar"
                    :timezone="timezoneOffsetInHours"
                    color-title="#fb6340"
                    color-text="#fff"
                    color-text-hl="#fff"
                    color-scale="#fff"
                    color-cross="#fb6340"
                    color-panel="#fb6340"
                    color-grid="#2d4b77"
                    color-back="#395380"/>
    </transition>
</template>

<script>
    import {TradingVue, DataCube} from 'trading-vue-js';
    import {gsap} from "gsap";

    export default {
        name: 'app',
        components: {TradingVue},
        props: {
            showToolbar: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                width: 0,
                height: 0,
                chart: new DataCube({ohlcv: this.chartData, onchart: [], offchart: []})
            }
        },
        computed: {
            chartData() {
                return this.$store.state.chartData;
            },
            windowSize() {
                return this.$store.state.windowSize;
            },
            betPoint() {
                return this.$store.state.betPoint;
            },
            timezoneOffsetInHours() {
                const offset = new Date().getTimezoneOffset() / 60;

                return offset < 0 ? Math.abs(offset) : -offset;
            }
        },
        watch: {
            chartData() {
                if (this.chartData) {
                    this.chart.set('chart.data', this.chartData);

                    this.resetChartPosition();
                }
            },
            betPoint(value) {
                this.updateBetPoint(value);
            },
            windowSize(value) {

                /* Предотвращение ошибки при попытке изменения несуществующего в DOM графика */
                if (this.$route.name !== 'Game') {
                    return;
                }

                this.onResize(value);
            }
        },
        methods: {
            updateBetPoint(value) {
                if (value) {
                    this.setBetPoint(value);
                } else {
                    this.removeBetPoint();
                }
            },
            setBetPoint(betPoint = null) {
                if (!betPoint) return;

                this.chart.add('onchart', {
                    name: 'Bet point',
                    type: 'Splitters',
                    loading: false,
                    data: [
                        [betPoint, this.$t('bet'), 0, 'rgb(59 117 226)', 0.4]
                    ],
                    settings: {
                        legend: false
                    }
                });
            },
            removeBetPoint() {
                this.chart.del('Bet point');
            },
            async resetChartPosition() {
                await this.$nextTick();

                const lastTimestamp = this.chartData[this.chartData.length - 1][0],
                    lastRangeEnd = this.$refs.chart.getRange()[1],
                    fiveMinutes = 5 * 60 * 1000;

                if (lastRangeEnd < (lastTimestamp - fiveMinutes)) {
                    return;
                }

                this.$refs.chart.goto(lastTimestamp + fiveMinutes);
            },
            onResize({x, y} = {x: window.innerWidth, y: window.innerHeight}) {
                const minHeight = 230;

                if (x < 850) {
                    this.width = x - (x / 12);
                } else {
                    this.width = (x / 1.4) - ((x / 2 - y) < 0 ? 0 : x / 2 - y);
                }

                let height;

                if (y < 700) {
                    height = minHeight;
                } else {
                    height = (y / 1.6) - ((y - x) < 0 ? 0 : y - x);
                }

                if (height < minHeight) {
                    height = minHeight;
                }

                this.height = height;
            },
            gameChartEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    xPercent: -20
                }, {
                    delay: 0.75,
                    duration: 0.8,
                    autoAlpha: 1,
                    xPercent: 0,
                    ease: 'elastic.out(0.8, 0.5)',
                    onComplete: done
                });
            }
        },
        mounted() {
            this.chart.set('chart.data', this.chartData);

            this.onResize();
        }
    }
</script>

<style lang="sass">
    #trading-vue-js
        overflow: hidden
        margin: 20px 30px
        background-color: var(--color-cloudy)
        border-radius: var(--default-border-radius)

        @media screen and (max-width: 720px)
            margin: 5px 15px 0 15px

        .trading-vue-tbitem
            filter: brightness(1.07) sepia(1) hue-rotate(-15deg) saturate(4.5) !important

            &.selected-item
                filter: brightness(2) sepia(1) hue-rotate(-15deg) saturate(4.5) !important
</style>
