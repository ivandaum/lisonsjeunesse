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
    [-10, 40],
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
            this.$images.forEach((image) => {
                image.addEventListener('mouseenter', () =>
                    this.$slider.classList.add('is-hover'),
                )
                image.addEventListener('mouseleave', () =>
                    this.$slider.classList.remove('is-hover'),
                )
            })
        }
    }

    onResize() {
        this.index = this.index || 0
        this.scroll = 0
        this.canScroll = true

        this.windowWidth = window.innerWidth
    }

    moveCircle(index, jumpTo) {
        this.$circles.forEach((targets, i) => {
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

        this.canScroll = false

        const event = normalizeWheel(e)
        const direction = event.pixelY > 0 ? 1 : -1
        const targets = { x: this.scroll }

        if (
            direction + this.index >= 0 &&
            direction + this.index < this.$items.length
        ) {
            this.index += direction
        }

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
    }
}

export default HomeRenderer
