<template>
    <transition :css="false"
                appear
                @leave="containerLeaveAnimation">
        <div v-if="!hide"
             :class="$style.container"
             @click="hide = true">
            <canvas ref="confetti"></canvas>

            <transition :css="false"
                        appear
                        @enter="cardEnterAnimation">
                <div :class="$style.card">
                    <div :class="$style['card-title']"
                         v-t="'cashback'"></div>

                    <div :class="$style['card-content']">
                        <img src="@/assets/img/thinking.svg" alt="">

                        <span v-t="'your-cashback'"></span>
                        :
                        <strong>{{ amount }} USD</strong>
                    </div>
                </div>
            </transition>

            <i v-for="num in 100"
               :key="num"
               class="rain"></i>
        </div>
    </transition>
</template>

<script>
    import {gsap} from 'gsap';

    export default {
        name: 'CashbackScene',
        props: ['amount'],
        data: () => ({
            hide: false
        }),
        computed: {
            isGameRoute() {
                return this.$route.name === 'Game';
            }
        },
        methods: {
            containerEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0
                }, {
                    delay: 0.2,
                    autoAlpha: 1,
                    duration: 0.5,
                    backgroundColor: 'rgba(128, 0, 0, 0.2)',
                    onComplete: done
                });
            },
            containerLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.15,
                    autoAlpha: 0,
                    onComplete: () => {
                        done();

                        this.$emit('hide');
                    }
                });
            },
            cardEnterAnimation(el, done) {
                if (!this.isGameRoute) {
                    return done();
                }

                const timeline = gsap.timeline();

                timeline
                    .from(el, {
                        scale: 10,
                        opacity: 0
                    })
                    .to(el, {
                        duration: 1,
                        scale: 0.8,
                        rotation: 5,
                        skewX: 0,
                        ease: 'elastic.out',
                        onComplete: () => {
                            timeline.to(el, {
                                duration: 0.4,
                                scale: 1,
                                rotation: 0,
                                x: 0,
                                ease: 'back.out',
                                onComplete() {
                                    el.style.transform = null;

                                    done();
                                }
                            });
                        }
                    });
            }
        }
    };
</script>

<style lang="sass"
       module>
    .container
        overflow: hidden
        position: fixed
        z-index: 1002
        width: 100%
        height: 100%
        top: 0
        left: 0
        background-color: rgba(128, 0, 0, 0.6)
        backdrop-filter: blur(5px)

        > canvas
            width: 100%
            height: 100vh

        .card
            position: fixed
            top: 50%
            left: 50%
            padding: 15px 40px
            text-align: center
            transform: translate(-50%, -50%)
            background-color: rgba(158, 122, 122, 0.8)
            border-radius: 20px / 40px

            .card-title
                margin-bottom: 6px
                font-size: 30px

            .card-content
                > img
                    margin: 10px
</style>

<style lang="scss">
    .rain {
        position: absolute;
        background: #fff;
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, #ffffff 100%);
        height: 50px;
        width: 1px;
    }

    $rain: 150;

    @for $i from 1 through $rain {
        $top: (random(50) + 50) * 1%;
        $left: random(100) * 1%;
        $opacity: (random(30) + 30) * 0.01;
        $delay: random(20) - 1s;

        .rain:nth-of-type(#{$i}) {
            animation-name: rain-#{$i};
            animation-delay: $delay;
            animation-duration: random(6) + 4s;
            animation-iteration-count: infinite;
            left: $left;
            opacity: $opacity;
            top: -$top;
        }

        @keyframes rain-#{$i} {
            0% {
                left: $left;
                opacity: $opacity;
                top: -$top;
            }

            100% {
                opacity: 0;
                top: $top + 40%;
            }
        }
    }

</style>
