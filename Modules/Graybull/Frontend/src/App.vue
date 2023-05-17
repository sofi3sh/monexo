<template>
    <div v-resize="onResize">
        <AppHeader v-if="dataReceived"/>

        <AppLoader/>

        <transition v-if="dataReceived"
                    :css="false"
                    mode="out-in"
                    @enter="viewEnterAnimation"
                    @leave="viewLeaveAnimation">
            <keepAlive>
                <RouterView/>
            </keepAlive>
        </transition>
    </div>
</template>

<script>
    import AppHeader from '@/components/AppHeader';
    import AppLoader from '@/components/AppLoader';
    import Resize from './directives/resize';
    import {gsap} from 'gsap';
    import axios from 'axios';

    export default {
        name: 'App',
        components: {
            AppHeader,
            AppLoader
        },
        directives: {Resize},
        data: () => ({
            dataReceived: false,
            routeTo: undefined
        }),
        computed: {
            windowSize: {
                get() {
                    return this.$store.state.windowSize;
                },
                set(windowSize) {
                    this.$store.commit('SET', {windowSize});
                }
            }
        },
        watch: {
            $route(to) {
                this.routeTo = to.name;
            }
        },
        methods: {
            onResize() {
                this.windowSize = {
                    x: window.innerWidth,
                    y: window.innerHeight
                };
            },
            async getGameRules() {
                const {data: gameRules} = await this.$store.dispatch('load', {
                    callback: () => axios.get('/graybull/game/get-rules'),
                    message: this.$t('loader-messages.getting-rules')
                });

                this.$store.commit('SET', {gameRules});
            },
            async getUserData() {
                const {data: userData} = await this.$store.dispatch('load', {
                    callback: () => axios.get('/graybull/game/get-user-data'),
                    message: this.$t('loader-messages.getting-user-data')
                });

                this.$setLanguage(userData.locale || 'ru');

                this.$store.commit('SET', {userData});
            },
            viewEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    xPercent: this.routeTo === 'Game' ? -50 : 50
                }, {
                    duration: 0.4,
                    autoAlpha: 1,
                    xPercent: 0,
                    ease: 'power4.out',
                    onComplete() {
                        el.style.transform = null;

                        done();
                    }
                });
            },
            viewLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.15,
                    autoAlpha: 0,
                    xPercent: this.routeTo !== 'Game' ? -50 : 50,
                    onComplete: done
                });
            }
        },
        async created() {
            await Promise.all([
                this.getGameRules(),
                this.getUserData()
            ]);

            await this.$nextTick();

            this.dataReceived = true;
        },
        mounted() {
            this.onResize();
        }
    }
</script>

<style lang="sass">
    @import "./styles/app"
</style>
