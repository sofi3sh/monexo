<template>
    <transition :css="false"
                appear
                @enter="burgerEnterAnimation">
        <div :class="[$style.burger, {[$style.active]: active}]"
             @click="$emit('toggle')">
            <button type="button"
                    :class="$style['burger-button']">
                <span :class="$style['burger-bar']"></span>
                <span :class="$style['burger-bar']"></span>
                <span :class="$style['burger-bar']"></span>
            </button>
        </div>
    </transition>
</template>

<script>
    import {gsap} from 'gsap';

    export default {
        name: 'AppHeaderBurger',
        props: {
            active: {
                type: Boolean,
                required: true
            }
        },
        methods: {
            burgerEnterAnimation(el, done) {
                gsap.from(el, {
                    delay: 1,
                    duration: 0.2,
                    autoAlpha: 0,
                    xPercent: 50,
                    ease: 'back.out',
                    onComplete: done
                });
            }
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    button:focus
        outline: 0

    .burger
        z-index: 111

        &.active
            .burger-button
                transform: rotate(-180deg)

                .burger-bar
                    &:nth-of-type(1)
                        transform: rotate(45deg)

                    &:nth-of-type(2)
                        opacity: 0

                    &:nth-of-type(3)
                        transform: rotate(-45deg)

    .burger-button
        position: relative
        height: 30px
        width: 32px
        display: block
        z-index: 999
        border: 0
        border-radius: 0
        background-color: transparent
        pointer-events: all
        cursor: pointer
        transition: transform .6s cubic-bezier(.165, .84, .44, 1)
        will-change: transform

        &:hover .burger-bar:nth-of-type(2)
            transform: scaleX(1)

        .burger-bar
            background-color: var(--color-orange)
            position: absolute
            top: 50%
            right: 6px
            left: 6px
            height: 2px
            width: auto
            margin-top: -1px
            transition: transform .6s cubic-bezier(.165, .84, .44, 1), opacity .3s cubic-bezier(.165, .84, .44, 1), background-color .6s cubic-bezier(.165, .84, .44, 1)
            will-change: transform, opacity, background-color

            &:nth-of-type(1)
                -webkit-transform: translateY(-6px)
                transform: translateY(-6px)

            &:nth-of-type(2)
                transform-origin: 100% 50%
                transform: scaleX(0.8)

            &:nth-of-type(3)
                transform: translateY(6px)
</style>
