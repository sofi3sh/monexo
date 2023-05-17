<template>
    <transition :css="false"
                @enter="wrapperEnterTransition"
                @leave="wrapperLeaveTransition">
        <div v-if="isOpen"
             :class="$style.wrapper"
             @click.self="() => {$emit('input'); $emit('close');}">
            <transition :css="false"
                        @appear="containerAppearTransition">
                <div :class="$style.container"
                     ref="container">
                    <div :class="$style.title"
                         v-if="title">
                        <span v-text="title"></span>

                        <span v-if="subtitle"
                              v-text="subtitle"></span>
                    </div>

                    <div :class="$style.content">
                        <slot/>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import {gsap} from 'gsap';

    export default {
        name: 'ModalWindow',
        props: {
            show: {
                type: Boolean,
                default: false
            },
            value: {
                type: Boolean,
                default: false
            },
            title: {
                type: String,
                default: null
            },
            subtitle: {
                type: String,
                default: null
            }
        },
        methods: {
            wrapperEnterTransition(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0
                }, {
                    duration: 0.1,
                    autoAlpha: 1,
                    onComplete() {
                        el.style.transform = null;

                        done();
                    }
                });
            },
            wrapperLeaveTransition(wrapperElement, done) {
                const {container: containerElement} = this.$refs,
                    containerDuration = 0.2;

                gsap.to(containerElement, {
                    duration: containerDuration,
                    scale: 0,
                    ease: 'back.in'
                });

                gsap.to(wrapperElement, {
                    delay: containerDuration,
                    duration: 0.22,
                    autoAlpha: 0,
                    onComplete: done
                });
            },
            containerAppearTransition(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    scale: 0.82
                }, {
                    duration: 0.5,
                    autoAlpha: 1,
                    scale: 1,
                    ease: 'elastic.out(0.8)',
                    onComplete() {
                        el.style.transform = null;

                        done();
                    }
                });
            }
        },
        computed: {
            isOpen() {
                return this.value || this.show;
            }
        }
    }
</script>

<style lang="sass"
       scoped
       module>
    .wrapper
        z-index: 99999
        position: fixed
        display: flex
        align-items: center
        justify-content: space-evenly
        top: 0
        left: 0
        width: 100%
        height: 100%
        background-color: var(--backdrop-color)
        cursor: pointer

        .container
            position: relative
            overflow: hidden
            max-width: 80vw
            max-height: 80vh
            display: flex
            flex-direction: column
            background-color: var(--color-cloudy)
            border-radius: 4px
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.08), 0 1px 10px 0 rgba(0, 0, 0, 0.02)
            cursor: initial

            > div
                padding: 10px 20px

            .title
                display: flex
                align-self: center
                flex-direction: column
                align-items: center

                > span
                    font-size: 18px

                    + span
                        opacity: 0.8
                        font-size: 14px

            .content
                overflow: auto
                max-width: 100%
                max-height: 100%
</style>
