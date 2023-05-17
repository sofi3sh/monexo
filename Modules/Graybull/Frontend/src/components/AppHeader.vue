<template>
    <div :class="$style.container">
        <header :class="$style.header">
            <transition :css="false"
                        appear
                        @enter="logoEnterAnimation">
                <div :class="$style.title">
                    <span v-text="title"></span>

                    <span v-if="!isGameRoute"
                          style="margin-left: 5px; color: #fff;"
                          v-text="$route.name"></span>
                </div>
            </transition>

            <nav v-if="isGameRoute">
                <transitionGroup :css="false"
                                 appear
                                 tag="section"
                                 style="z-index: 101;"
                                 @enter="itemsEnterAnimation">
                    <AppSelect :key="'tool'"
                               v-model="tool.value"
                               :options="tool.options"
                               :disabled="loading || activeBetExists">
                        <template #selected-option="{option}">
                            <div :class="$style['selected-option']">
                                <i class="material-icons"
                                   v-text="'handyman'"></i>

                                <span v-text="option"></span>
                            </div>
                        </template>
                    </AppSelect>

                    <AppSelect :key="'balance'"
                               v-model="selectedBalance"
                               :options="balanceOptions"
                               :disabled="loading || activeBetExists">
                        <template #selected-option="{option}">
                            <div :class="$style['selected-option']">
                                <i class="material-icons"
                                   v-text="'monetization_on'"></i>
                                <span v-text="userBalances[option]"></span>

                                <span style="margin-left: 5px; text-transform: uppercase;"
                                      v-text="option"></span>
                            </div>
                        </template>

                        <template #option="{option}">
                            <span v-text="userBalances[option]"></span>

                            <span style="margin-left: 5px; text-transform: uppercase;"
                                  v-text="option"></span>
                        </template>
                    </AppSelect>

                    <AppSelect :key="'lang'"
                               :options="lang.options"
                               :value="lang.value"
                               :disabled="loading"
                               @input="setLanguage">
                        <template #selected-option="{option}">
                            <div :class="$style['selected-option']">
                                <i class="material-icons"
                                   v-text="'language'"></i>

                                <span style="text-transform: uppercase;"
                                      v-text="option"></span>
                            </div>
                        </template>

                        <template #option="{option}">
                            <span style="text-transform: uppercase;"
                                  v-text="option"></span>
                        </template>
                    </AppSelect>
                </transitionGroup>

                <transitionGroup :css="false"
                                 appear
                                 tag="section"
                                 @enter="itemsEnterAnimation">
                    <routerLink to="history"
                                :key="'history'"
                                :class="[$style['header-link'], {[$style.disabled]: loading}]">
                        <i class="material-icons"
                           v-text="'history'"></i>

                        <span v-t="'history'"></span>
                    </routerLink>

                    <routerLink to="statistic"
                                :key="'statistic'"
                                :class="[$style['header-link'], {[$style.disabled]: loading}]">
                        <i class="material-icons"
                           v-text="'analytics'"></i>

                        <span v-t="'statistic'"></span>
                    </routerLink>

                    <a :key="'cabinet'"
                       :class="[$style['header-link'], {[$style.disabled]: loading}]"
                       @click.prevent="goToCabinet()">
                        <i class="material-icons"
                           v-text="'meeting_room'"></i>

                        <span v-t="'to-cabinet'"></span>
                    </a>
                </transitionGroup>
            </nav>

            <AppHeaderBurger v-if="isGameRoute"
                             :id="$style['sidebar-toggle']"
                             :active="showSidebar"
                             @toggle="showSidebar = !showSidebar"/>

            <AppHeaderSidebar v-if="isGameRoute"
                              :id="$style.sidebar"
                              :active="showSidebar"
                              @close="showSidebar = false">
                <ul>
                    <li style="margin-bottom: 25px;">
                        <div :class="$style.title"
                             v-text="title"></div>
                    </li>

                    <li>
                        <AppSelect v-model="tool.value"
                                   :options="tool.options"
                                   :disabled="loading || activeBetExists">
                            <template #selected-option="{option}">
                                <div :class="$style['selected-option']">
                                    <i class="material-icons"
                                       v-text="'handyman'"></i>

                                    <span v-text="option"></span>
                                </div>
                            </template>
                        </AppSelect>
                    </li>

                    <li>
                        <AppSelect v-model="selectedBalance"
                                   :options="balanceOptions"
                                   :disabled="loading || activeBetExists">
                            <template #selected-option="{option}">
                                <div :class="$style['selected-option']">
                                    <i class="material-icons"
                                       v-text="'monetization_on'"></i>

                                    <span v-text="userBalances[option]"></span>

                                    <span style="margin-left: 5px; text-transform: uppercase;"
                                          v-text="option"></span>
                                </div>
                            </template>

                            <template #option="{option}">
                                <span v-text="userBalances[option]"></span>

                                <span style="margin-left: 5px; text-transform: uppercase;"
                                      v-text="option"></span>
                            </template>
                        </AppSelect>
                    </li>

                    <li>
                        <AppSelect v-model="lang.value"
                                   :options="lang.options"
                                   :disabled="loading"
                                   @input="setLanguage">
                            <template #selected-option="{option}">
                                <div :class="$style['selected-option']">
                                    <i class="material-icons"
                                       v-text="'language'"></i>

                                    <span style="text-transform: uppercase;"
                                          v-text="option"></span>
                                </div>
                            </template>

                            <template #option="{option}">
                                <span style="text-transform: uppercase;"
                                      v-text="option"></span>
                            </template>
                        </AppSelect>
                    </li>

                    <li style="height: 1px; margin: 8px 0; background-color: #152440;"></li>

                    <li>
                        <routerLink to="history"
                                    :class="[$style['header-link'], {[$style.disabled]: loading}]"
                                    @click.native="showSidebar = false">
                            <i class="material-icons"
                               v-text="'history'"></i>

                            <span v-t="'history'"></span>
                        </routerLink>
                    </li>

                    <li>
                        <routerLink to="statistic"
                                    :class="[$style['header-link'], {[$style.disabled]: loading}]"
                                    @click.native="showSidebar = false">
                            <i class="material-icons"
                               v-text="'analytics'"></i>

                            <span v-t="'statistic'"></span>
                        </routerLink>
                    </li>

                    <li>
                        <a :class="[$style['header-link'], {[$style.disabled]: loading}]"
                           @click.prevent="goToCabinet()">
                            <i class="material-icons"
                               v-text="'meeting_room'"></i>

                            <span v-t="'to-cabinet'"></span>
                        </a>
                    </li>
                </ul>
            </AppHeaderSidebar>
        </header>
    </div>
</template>

<script>
    import {gsap} from 'gsap';
    import axios from 'axios';
    import AppSelect from '@/components/AppSelect';
    import AppHeaderBurger from '@/components/AppHeaderBurger';
    import AppHeaderSidebar from '@/components/AppHeaderSidebar';

    const timeline = gsap.timeline();

    export default {
        name: 'AppHeader',
        components: {
            AppSelect,
            AppHeaderBurger,
            AppHeaderSidebar
        },
        data() {
            return {
                title: 'Graybull',
                showSidebar: false,
                isRouteChanged: false,
                tool: {
                    value: null,
                    options: ['BTC/USD']
                },
                lang: {
                    value: null,
                    options: ['ru', 'en']
                }
            }
        },
        computed: {
            loading() {
                return this.$store.getters.loading;
            },
            activeBetExists() {
                return Boolean(this.$store.state.activeBet);
            },
            selectedBalance: {
                get() {
                    return this.$store.state.selectedBalance;
                },
                set(value) {
                    return this.$store.commit('SET', {selectedBalance: value});
                }
            },
            isGameRoute() {
                return this.$route.name === 'Game';
            },
            userData() {
                return this.$store.state.userData;
            },
            userBalances() {
                if (typeof this.userData.balance_usd !== 'number') {
                    return {};
                }

                return {
                    usd: this.userData.balance_usd,
                    btc: this.userData.balance_btc,
                    eth: this.userData.balance_eth,
                    pzm: this.userData.balance_pzm
                };
            },
            balanceOptions() {
                return Object.keys(this.userBalances);
            },
            windowSize() {
                return this.$store.state.windowSize;
            }
        },
        watch: {
            $route() {
                this.isRouteChanged = true;
            }
        },
        methods: {
            setLanguage(lang) {
                if (!lang || this.$getLanguage() === lang) {
                    return;
                }

                this.lang.value = lang;

                this.$setLanguage(lang);

                axios.get(location.origin + '/lang/' + lang)
            },
            async goToCabinet() {
                await this.$store.dispatch('addMessageToLoader', this.$t('loader-messages.going-to-cabinet'));

                this.$nextTick(() => {
                    window.location.href = (window.location.origin + '/home')
                });
            },
            logoEnterAnimation(el, done) {
                timeline.fromTo(el, {
                    autoAlpha: 0,
                    scale: 0
                }, {
                    duration: 0.6,
                    autoAlpha: 1,
                    scale: 1,
                    ease: 'back',
                    onComplete: done
                });
            },
            itemsEnterAnimation(el, done) {
                if (this.isRouteChanged) {
                    timeline.fromTo(el, {
                        autoAlpha: 0
                    }, {
                        duration: 0.25,
                        autoAlpha: 1,
                        onComplete: done
                    }, '-=0.15');

                    return;
                }

                timeline.fromTo(el, {
                    autoAlpha: 0,
                    yPercent: -150
                }, {
                    duration: 0.45,
                    autoAlpha: 1,
                    yPercent: 0,
                    ease: 'bounce',
                    onComplete: done
                }, '-=0.22');
            }
        },
        created() {
            this.lang.value = this.userData.locale || 'ru';
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    .container
        padding: 10px 25px

        @media screen and (max-width: 990px)
            > .header
                .selected-option
                    margin-left: 0
                    padding-right: 5px

                #sidebar-toggle,
                #sidebar
                    display: block

                > nav
                    > section
                        display: none !important


        @media screen and (max-width: 850px)
            padding: 6px 20px

            > .header
                .title
                    font-size: 25px !important

        .selected-option,
        .header-link
            display: flex
            align-items: center
            margin: 0 2px
            padding: 5px
            line-height: 1

            > i
                margin-right: 5px

        .header-link.disabled
            pointer-events: none
            opacity: 0.6 !important

        #sidebar-toggle,
        #sidebar
            display: none

        .header
            display: flex
            align-items: center

            .title
                font-size: 30px
                color: var(--color-orange)

            nav
                display: flex
                align-items: center
                justify-content: space-between
                width: 100%
                padding: 0 5%

                > section
                    display: flex

            ul li
                list-style-type: none
</style>
