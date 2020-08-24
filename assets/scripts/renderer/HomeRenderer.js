import Highway from '@dogstudio/highway'
import Lazyloading from '../vendor/Lazyloading'
import normalizeWheel from 'normalize-wheel'
import anime from 'animejs'

const CIRCLE_POSITIONS = [
    [-50, -50],
    [-10, -50],
    [40, -50],
    [50, 0],
    [50, 40],
    [-10, 30],
    [-50, 40],
]

class HomeRenderer extends Highway.Renderer {
    onLeave() {
        if (this.slider) {
            this.slider.destroy()
        }
    }

    onEnter() {}

    onEnterCompleted() {
        this.Lazyloading = new Lazyloading({
            load_delay: 0,
            elements_selector: 'img, .lazy',
            use_native: false,
        })

        this.$slider = document.querySelector('.js-slider')
        this.$items = document.querySelectorAll('.js-slider-item')
        this.$circles = document.querySelectorAll('.js-circle')
        this.$images = document.querySelectorAll('.js-image')

        this.onResize()
        this.$items[0].classList.add('is-active')
        this.moveCircle(this.index, true)

        if (this.windowWidth > 1000) {
            window.addEventListener('wheel', this.onScroll.bind(this))
            this.$images.forEach((img, i) => {
                img.addEventListener('mouseenter', () => {
                    if (this.$items[i].classList.contains('is-active')) {
                        this.$slider.classList.add('is-hover')
                        this.$items[i].classList.add('is-hover')
                    }
                })
                img.addEventListener('mouseleave', () => {
                    this.$slider.classList.remove('is-hover')
                    this.$items[i].classList.remove('is-hover')
                })
            })
        }
    }

    onResize() {
        this.index = this.index || 0
        this.scroll = 0
        this.canScroll = true
        this.$slider.scrollTo(0, 0)

        this.windowWidth = window.innerWidth
    }

    moveCircle(index, jumpTo) {
        this.$circles.forEach((targets) => {
            const dataIndex = parseInt(targets.dataset.indexpos)

            let ind = dataIndex + index
            if (ind >= CIRCLE_POSITIONS.length) {
                ind -= CIRCLE_POSITIONS.length
            }

            const xyz = CIRCLE_POSITIONS[ind]
            const divs = targets.querySelectorAll(`div`)

            divs.forEach((el, a) =>
                a === this.index
                    ? el.classList.add('is-active')
                    : el.classList.remove('is-active'),
            )

            anime({
                targets,
                duration: jumpTo ? 0 : 1500,
                easing: 'easeInOutExpo',
                translateX: xyz[0] + 'vw',
                translateY: xyz[1] + 'vh',
                translateZ: 1,
            })
        })
    }

    onScroll(e) {
        if (!this.canScroll) {
            return false
        }

        const event = normalizeWheel(e)
        const direction = event.pixelY > 0 ? 1 : -1
        const targets = { x: this.scroll }

        if (
            direction + this.index >= 0 &&
            direction + this.index < this.$items.length
        ) {
            this.index += direction
        } else {
            return false
        }

        this.$slider.classList.remove('is-hover')
        this.$slider.classList.add('is-scrolling')

        this.canScroll = false

        let x = 0
        this.$items.forEach((el, i) => {
            if (i < this.index) {
                x += el.offsetWidth
            }

            if (i === this.index) {
                el.classList.add('is-active')
            } else {
                el.classList.remove('is-active')
            }
        })

        this.moveCircle(this.index)

        anime({
            targets,
            x,
            duration: 1500,
            easing: 'easeInOutExpo',
            update: () => {
                this.$slider.scrollTo(targets.x, 0)
            },
            complete: () => {
                this.scroll = x
                this.canScroll = true
            },
        })

        setTimeout(() => this.$slider.classList.remove('is-scrolling'), 1000)
    }
}

export default HomeRenderer
