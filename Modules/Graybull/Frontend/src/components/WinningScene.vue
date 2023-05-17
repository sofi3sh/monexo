<template>
    <transition :css="false"
                appear
                @enter="containerEnterAnimation"
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
                         v-t="'victory'"></div>

                    <div :class="$style['card-content']">
                        <img src="@/assets/img/rich.svg" alt="">

                        <span v-t="'your-income'"></span>
                        :
                        <strong>{{ amount }} USD</strong>
                    </div>
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import {gsap} from 'gsap';

    export default {
        name: 'WinningScene',
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
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
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
                        duration: 0.4,
                        x: -35,
                        ease: 'power2.out'
                    })
                    .to(el, {
                        duration: 0.1,
                        scale: 1,
                        x: 20,
                        skewX: -10
                    })
                    .to(el, {
                        duration: 0.1,
                        x: -20,
                        skewX: 10
                    })
                    .to(el, {
                        duration: 0.1,
                        x: 20,
                        skewX: -10
                    })
                    .to(el, {
                        duration: 0.1,
                        x: -20,
                        skewX: 10
                    })
                    .to(el, {
                        duration: 0.4,
                        scale: 1.4,
                        rotation: -10,
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
        },
        mounted() {
            const confetti = this.$refs.confetti;
            const confettiCtx = confetti.getContext('2d'),
                rand = (min, max) => Math.random() * (max - min) + min;

            let container,
                confettiLeft = 5,
                confettiElements = [],
                clickPosition;

            const confettiParams = {
                number: 50,
                size: {x: [5, 20], y: [10, 18]},
                initSpeed: 25,
                gravity: 0.65,
                drag: 0.08,
                terminalVelocity: 6,
                flipSpeed: 0.017
            };
            const colors = [
                {front: '#3B870A', back: '#235106'},
                {front: '#B96300', back: '#6f3b00'},
                {front: '#E23D34', back: '#88251f'},
                {front: '#CD3168', back: '#7b1d3e'},
                {front: '#664E8B', back: '#3d2f53'},
                {front: '#394F78', back: '#222f48'},
                {front: '#008A8A', back: '#005353'}
            ];

            setupCanvas();
            updateConfetti();

            confetti.addEventListener('click', addConfetti);

            function Conf() {
                this.randomModifier = rand(-1, 1);
                this.colorPair = colors[Math.floor(rand(0, colors.length))];
                this.dimensions = {
                    x: rand(confettiParams.size.x[0], confettiParams.size.x[1]),
                    y: rand(confettiParams.size.y[0], confettiParams.size.y[1])
                };
                this.position = {
                    x: clickPosition[0],
                    y: clickPosition[1]
                };
                this.rotation = rand(0, 2 * Math.PI);
                this.scale = {x: 1, y: 1};
                this.velocity = {
                    x: rand(-confettiParams.initSpeed, confettiParams.initSpeed) * 0.4,
                    y: rand(-confettiParams.initSpeed, confettiParams.initSpeed)
                };
                this.flipSpeed = rand(0.2, 1.5) * confettiParams.flipSpeed;

                if (this.position.y <= container.h) {
                    this.velocity.y = -Math.abs(this.velocity.y);
                }

                this.terminalVelocity = rand(1, 1.5) * confettiParams.terminalVelocity;

                this.update = function () {
                    this.velocity.x *= 0.98;
                    this.position.x += this.velocity.x;

                    this.velocity.y += (this.randomModifier * confettiParams.drag);
                    this.velocity.y += confettiParams.gravity;
                    this.velocity.y = Math.min(this.velocity.y, this.terminalVelocity);
                    this.position.y += this.velocity.y;

                    this.scale.y = Math.cos((this.position.y + this.randomModifier) * this.flipSpeed);
                    this.color = this.scale.y > 0 ? this.colorPair.front : this.colorPair.back;
                }
            }

            function updateConfetti() {
                confettiCtx.clearRect(0, 0, container.w, container.h);

                confettiElements.forEach((c) => {
                    c.update();
                    confettiCtx.translate(c.position.x, c.position.y);
                    confettiCtx.rotate(c.rotation);
                    const width = (c.dimensions.x * c.scale.x);
                    const height = (c.dimensions.y * c.scale.y);
                    confettiCtx.fillStyle = c.color;
                    confettiCtx.fillRect(-0.5 * width, -0.5 * height, width, height);
                    confettiCtx.setTransform(1, 0, 0, 1, 0, 0)
                });

                confettiElements.forEach((c, idx) => {
                    if (c.position.y > container.h ||
                        c.position.x < -0.5 * container.x ||
                        c.position.x > 1.5 * container.x) {
                        confettiElements.splice(idx, 1)
                    }
                });
                window.requestAnimationFrame(updateConfetti);
            }

            function setupCanvas() {
                container = {
                    w: confetti.clientWidth,
                    h: confetti.clientHeight
                };
                confetti.width = container.w;
                confetti.height = container.h;
            }

            function addConfetti(e) {
                const canvasBox = confetti.getBoundingClientRect();
                if (e) {
                    clickPosition = [
                        e.clientX - canvasBox.left,
                        e.clientY - canvasBox.top
                    ];
                } else {
                    clickPosition = [
                        canvasBox.width * Math.random(),
                        canvasBox.height * Math.random()
                    ];
                }
                for (let i = 0; i < confettiParams.number; i++) {
                    confettiElements.push(new Conf())
                }
            }

            function hideConfetti() {
                window.cancelAnimationFrame(updateConfetti);
            }

            confettiLoop();

            let lastConfettiTimerTime;

            function confettiLoop() {
                if (!confettiLeft) {
                    return;
                }

                lastConfettiTimerTime = 700 + Math.random() * 800;

                addConfetti();

                confettiLeft--;

                if (confettiLeft === 1) {
                    setTimeout(() => hideConfetti(), lastConfettiTimerTime);
                }

                setTimeout(confettiLoop, lastConfettiTimerTime);
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
        background-color: rgba(0, 128, 0, 0.6)
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
            background-color: rgb(122, 158, 122, 0.8)
            border-radius: 20px / 40px

            .card-title
                margin-bottom: 6px
                font-size: 30px

            .card-content
                > img
                    margin: 10px
</style>
