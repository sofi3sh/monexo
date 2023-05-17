import Vue from 'vue'
import VueRouter from 'vue-router'
import Game from '../views/Game'

Vue.use(VueRouter)

const routes = [
    {
        path: '/game',
        name: 'Game',
        component: Game
    },
    {
        path: '/history',
        name: 'History',
        component: () => import('../views/History')
    },
    {
        path: '/statistic',
        name: 'Statistic',
        component: () => import('../views/Statistic')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.VUE_APP_BASE_URL,
    routes
})

export default router
