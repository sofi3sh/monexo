<template>
    <div :class="$style.sidebar">
        <div v-if="active"
             :class="$style['sidebar-backdrop']"
             @click="$emit('close')"></div>

        <transition name="slide">
            <div v-if="active"
                 :class="$style['sidebar-panel']">
                <slot/>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: 'AppHeaderSidebar',
        props: {
            active: {
                type: Boolean,
                required: true
            }
        }
    }
</script>

<style lang="sass"
       module
       scoped>
    .sidebar
        z-index: 110

        .sidebar-backdrop
            z-index: 1
            position: fixed
            width: 100vw
            height: 100vh
            top: 0
            right: 0
            background-color: var(--backdrop-color)
            cursor: pointer

        .sidebar-panel
            z-index: 2
            overflow-y: auto
            position: fixed
            min-width: 50%
            max-width: calc(100% - 65px)
            height: 100vh
            right: 0
            top: 0
            padding: 3rem 20px 2rem 20px
            background-color: #192b4d
</style>

<style lang="sass"
       scoped>
    .slide-enter-active,
    .slide-leave-active
        transition: transform 0.2s ease

    .slide-enter,
    .slide-leave-to
        transform: translateX(100%)
        transition: all 150ms ease-in 0s
</style>
