import Highway from '@dogstudio/highway'
import Lazyloading from '../vendor/Lazyloading'
import RafManager from '../utils/RafManager'
import normalizeWheel from 'normalize-wheel'
import anime from 'animejs'

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
        this.$images = document.querySelectorAll('.js-image')

        this.onResize()

        if (this.windowWidth > 1000) {
            window.addEventListener('wheel', this.onScroll.bind(this))
            RafManager.addQueue(this.render.bind(this))

            this.$images.forEach((image) => {
                image.addEventListener('mouseenter', () =>
                    this.$slider.classList.add('is-hover'),
                )
                image.addEventListener('mouseleave', () =>
                    this.$slider.classList.remove('is-hover'),
                )
            })

            this.onScrollCompleted()
        }
    }
    onResize() {
        this.scrollTimeout = null
        this.windowWidth = window.innerWidth
        this.windowHeight = window.innerHeight

        this.canScroll = true
        this.scroll = 0
        this.scrollEased = 0

        this.itemWidth = this.$items[0].offsetWidth
        this.itemsPosition = Array.from(this.$items).map(
            (item, index) => this.itemWidth * index,
        )

        this.width = this.itemWidth * this.$items.length
        this.margin = this.windowWidth * 0.5 // total margin left AND right
        this.max = this.width - this.margin
    }

    onScroll(e) {
        if (!this.canScroll) {
            return false
        }

        const event = normalizeWheel(e)
        this.scroll += event.pixelY * 0.75
        this.scroll = Math.min(this.max, Math.max(0, this.scroll))

        this.$slider.classList.add('is-scrolling')
        this.$items.forEach((item) => item.classList.remove('is-active'))

        clearTimeout(this.scrollTimeout)
        this.scrollTimeout = setTimeout(() => this.onScrollCompleted(), 400)
    }

    onScrollCompleted() {
        this.canScroll = false
        this.$slider.classList.remove('is-scrolling')

        let index = null
        const w = this.itemWidth * 0.5

        for (let i = 0; i < this.itemsPosition.length; i++) {
            const itemX = this.itemsPosition[i]

            if (this.scroll >= itemX - w && this.scroll < itemX + w) {
                index = i
            }
        }

        this.$items[index].classList.add('is-active')

        const x = this.itemsPosition[index]
        const targets = { x: this.scroll }
        anime({
            targets,
            x,
            update: () => {
                this.scroll = targets.x
            },
            duration: 1000,
            easing: 'easeInOutExpo',
            complete: () => {
                this.canScroll = true
            },
        })
    }

    render() {
        this.scrollEased += (this.scroll - this.scrollEased) * 0.2

        this.$items.forEach(
            (item) =>
                (item.style.transform = `translateX(${-this.scrollEased}px)`),
        )
    }
}

export default HomeRenderer
