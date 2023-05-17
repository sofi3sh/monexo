<template>
    <div :class="$style.container">
        <div :class="$style.title">
            <slot name="title"/>
        </div>

        <transition :css="false"
                    @enter="backLinkEnterAnimation">
            <routerLink to="game"
                        v-if="showBackLink"
                        :class="$style.back">
                <i class="material-icons md-26"
                   v-text="'navigate_before'"></i>

                <span v-t="'back-to-game'"></span>
            </routerLink>
        </transition>

        <slot/>
    </div>
</template>

<script>
    import {gsap} from "gsap";

    export default {
        name: 'ViewPage',
        data: () => ({
            showBackLink: false
        }),
        methods: {
            backLinkEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    scale: 0,
                }, {
                    duration: 0.3,
                    autoAlpha: 1,
                    scale: 1,
                    transformOrigin: 'left center',
                    ease: 'back.out(1.2)',
                    onComplete: done
                });
            }
        },
        activated() {
            setTimeout(() => (this.showBackLink = true), 150);
        },
        deactivated() {
            this.showBackLink = false;
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    .container
        position: relative
        display: flex
        flex-direction: column
        align-items: center
        padding: 20px

        .back
            position: absolute
            display: flex
            align-items: center
            top: 0
            left: 20px
            font-size: 20px

        .title
            margin: 20px
            font-size: 30px
</style>
