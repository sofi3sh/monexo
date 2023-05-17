<template>
    <transition :css="false"
                appear
                @enter="loaderContainerEnterAnimation"
                @leave="loaderContainerLeaveAnimation">
        <transitionGroup v-if="showContainer"
                         :class="$style.container"
                         :css="false"
                         tag="div"
                         @enter="loaderMessagesEnterAnimation"
                         @leave="loaderMessagesLeaveAnimation">
            <div v-for="message in loaderMessages"
                 :key="message"
                 :class="$style.message">
                <div :class="$style.spinner"></div>

                <div v-text="message"></div>
            </div>
        </transitionGroup>
    </transition>
</template>

<script>
    import {gsap} from 'gsap';

    export default {
        name: 'AppLoader',
        computed: {
            loaderMessages() {
                return this.$store.state.loader.messages;
            },
            showContainer() {
                return Boolean(this.loaderMessages.length);
            }
        },
        methods: {
            loaderContainerEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    y: -40
                }, {
                    duration: 0.3,
                    autoAlpha: 1,
                    y: 0,
                    ease: 'expo.out',
                    onComplete: done
                });
            },
            loaderContainerLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.3,
                    autoAlpha: 0,
                    y: -40,
                    ease: 'back.in',
                    onComplete: done
                });
            },
            loaderMessagesEnterAnimation(el, done) {
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
                    onComplete: done
                });
            },
            loaderMessagesLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.3,
                    autoAlpha: 0,
                    y: -20,
                    position: 'absolute',
                    ease: 'expo.out',
                    onComplete: done
                });
            }
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    .container
        z-index: 10
        position: fixed
        top: 10px
        left: 50%
        display: flex
        flex-direction: column
        padding: 5px 10px
        transform: translateX(-50%)
        border-radius: 10px
        background-color: var(--color-cloudy)

        .message
            white-space: nowrap
            display: inline-flex
            margin: 1px 0
            font-size: 12px

            .spinner
                display: inline-block
                width: 12px
                height: 12px
                margin-right: 4px
                border: 2px solid rgba(255, 255, 255, .3)
                border-radius: 50%
                border-top-color: #fff
                animation: spin 300ms linear infinite

                @keyframes spin
                    to
                        transform: rotate(360deg)
</style>
