import Highway from '@dogstudio/highway'
import Lazyloading from '../vendor/Lazyloading'
import RafManager from '../utils/RafManager'
import normalizeWheel from 'normalize-wheel'
import { range } from '../functions'

class HomeRenderer extends Highway.Renderer {
    onLeave() {
        if (this.slider) {
            this.slider.destroy()
        }
    }
    onEnter() {}

    onEnterCompleted() {
        this.Lazyloading = new Lazyloading({
            load_delay: 500,
            elements_selector: 'img, .lazy',
            use_native: false,
        })

        this.$slider = document.querySelector('.js-slider')
        this.$items = document.querySelectorAll('.js-slider-item')
        this.scrollTimeout = null

        this.onResize()

        if (this.windowWidth > 1000) {
            window.addEventListener('wheel', this.onScroll.bind(this))
            RafManager.addQueue(this.render.bind(this))
        }
    }
    onResize() {
        this.windowWidth = window.innerWidth
        this.windowHeight = window.innerHeight

        this.scroll = 0
        this.scrollEased = 0

        this.itemWidth = this.$items[0].offsetWidth
        this.width = this.itemWidth * this.$items.length
        this.margin = this.windowWidth * 0.5 // total margin left AND right
        this.max = this.width - this.margin
    }

    onScroll(e) {
        const event = normalizeWheel(e)
        this.scroll += event.pixelY * 0.75

        this.scroll = Math.min(this.max, Math.max(0, this.scroll))

        // clearTimeout(this.scrollTimeout)
        // this.scrollTimeout = null
        // this.scrollTimeout = setTimeout(() => this.onScrollCompleted(), 100)
    }

    onScrollCompleted() {
        const percent = range(this.scroll, 0, this.max) * 0.01
        const itemIndex = Math.round(this.$items.length * percent)
        console.log(
            this.$items[itemIndex].querySelector('.Home__category').innerHTML,
        )
        const x = itemIndex * this.itemWidth
        this.scroll = x
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
