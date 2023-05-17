<!-- Интеграция верстки Данила -->

<template>
    <div class="popup menu active">
        <ul class="container">
            <li>
                <a href="#" @click="$bus.$emit('open-popup', 'history')">
                    {{ $t('history') }}
                    <img src="@/assets/img/clock.svg" alt="">
                </a>
            </li>

            <li>
                <a href="#" @click="$bus.$emit('open-popup', 'statistic')">
                    {{ $t('statistic') }}
                    <img src="@/assets/img/business.svg" alt="">
                </a>
            </li>

            <li>
                <a :href="toCabinetUrl">
                    {{ $t('to-cabinet') }}
                    <img src="@/assets/img/signs.svg" alt="">
                </a>
            </li>

            <li>
                <a href="#">
                    {{ $t('rules') }}
                    <img src="@/assets/img/terms.svg" alt="">
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'GameHamburger',
        computed: {
            toCabinetUrl() {
                return location.origin + '/home';
            }
        }
    }
</script>
