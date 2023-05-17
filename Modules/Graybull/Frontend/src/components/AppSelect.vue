<template>
    <div :class="containerClasses"
         :tabindex="tabindex"
         :style="[isOpen ? {zIndex: 2} : {zIndex: 1}]"
         @blur="isOpen = false">
        <div :class="$style.content">
            <div :class="[$style['selected-option'], {[$style.active]: isOpen}]"
                 @click="!disabled && (isOpen = !isOpen)">
                <slot v-if="isSelectedOptionSlotActive"
                      name="selected-option"
                      :option="value"/>

                <span v-else
                      v-text="value"></span>
            </div>

            <transition :css="false"
                        appear
                        @enter="optionsEnterAnimation"
                        @leave="optionsLeaveAnimation">
                <div v-if="isOpen"
                     :class="$style.options">
                    <div v-for="(option, index) of options"
                         :key="index"
                         :class="{[$style.selected]: value === option}"
                         @click="!disabled && select(option)">
                        <slot v-if="isOptionSlotActive"
                              name="option"
                              :option="option"/>

                        <span v-else
                              v-text="option"></span>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import {gsap} from 'gsap';

    export default {
        name: 'AppSelect',
        props: {
            value: {
                required: true
            },
            options: {
                type: Array,
                required: true
            },
            tabindex: {
                type: Number,
                default: 0
            },
            disabled: {
                type: Boolean,
                default: false
            },
            hideArrow: {
                type: Boolean,
                default: false
            },
            direction: {
                type: String,
                default: 'down',
                validator(value) {
                    return ['up', 'down'].includes(value);
                }
            }
        },
        data() {
            return {
                isOpen: false
            };
        },
        computed: {
            isOptionSlotActive() {
                return Boolean(this.$scopedSlots['option']);
            },
            isSelectedOptionSlotActive() {
                return Boolean(this.$scopedSlots['selected-option']);
            },
            containerClasses() {
                return [
                    this.$style.container,
                    {[this.$style.open]: this.isOpen},
                    {[this.$style.disabled]: this.disabled},
                    {[this.$style['hide-arrow']]: this.hideArrow},
                    this.$style['direction-' + this.direction]
                ];
            }
        },
        methods: {
            select(option) {
                this.isOpen = false;

                this.$emit('input', option);
            },
            optionsEnterAnimation(el, done) {
                gsap.fromTo(el, {
                    autoAlpha: 0,
                    y: this.direction === 'up' ? 20 : -20
                }, {
                    duration: 0.25,
                    autoAlpha: 1,
                    y: 0,
                    ease: 'back.out',
                    onComplete: done
                });
            },
            optionsLeaveAnimation(el, done) {
                gsap.to(el, {
                    duration: 0.2,
                    autoAlpha: 0,
                    y: this.direction === 'up' ? 15 : -15,
                    ease: 'back.in',
                    onComplete: done
                });
            }
        },
        mounted() {
            if (!this.value) {
                this.$emit('input', this.options[0] || null);
            }
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    .container
        white-space: nowrap
        position: relative
        display: inline-flex
        width: 100%
        outline: none
        user-select: none

        &.direction-up
            .content
                .selected-option:after
                    bottom: 55%
                    border-bottom-color: #fff
                    transform: translateY(50%)

                .options
                    bottom: 100%

        &.direction-down
            .content
                .selected-option:after
                    top: 55%
                    border-top-color: #fff
                    transform: translateY(-50%)

                .options
                    top: 100%

        &.hide-arrow
            .content
                margin-right: 0

                .selected-option:after
                    display: none

        .content
            position: relative
            margin-right: 10px

            .selected-option
                position: relative
                transition: color 140ms ease-out
                will-change: color
                cursor: pointer

                &.active
                    color: var(--color-cloudy-light)

                &:after
                    content: ''
                    position: absolute
                    width: 0
                    height: 0
                    right: -6px
                    border: 4px solid transparent

            .options
                overflow: hidden
                position: absolute
                left: 100%
                transform: translateX(-100%)
                background-color: var(--color-cloudy)
                border-radius: var(--default-border-radius)
                box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.08), 0 1px 10px 0 rgba(0, 0, 0, 0.06)

                > div
                    padding: 5px
                    transition: background-color 100ms
                    will-change: background-color
                    cursor: pointer

                    &.selected,
                    &:hover
                        background-color: var(--color-cloudy-light)

        &.open
            &.direction-up
                .selected-option:after
                    transform: translateY(100%)
                    border-bottom-color: transparent
                    border-top-color: var(--color-cloudy-light)

            &.direction-down
                .selected-option:after
                    transform: translateY(-100%)
                    border-top-color: transparent
                    border-bottom-color: var(--color-cloudy-light)

        &.disabled
            pointer-events: none
            opacity: 0.6 !important
</style>
