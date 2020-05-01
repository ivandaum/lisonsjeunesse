import RafManager from '../utils/RafManager'
import { range, rand, randFloat } from '../functions'
import anime from 'animejs'

export default class HomeSlider {
    constructor() {
        this.$container = document.querySelector('.js-slider')
        this.$items = document.querySelectorAll('.js-slider-item')
        this.$circlesDiv = document.querySelector('.js-slider-circleDiv')
        this.$circles = document.querySelectorAll('.js-slider-circle')
        this.$circlesImages = Array.from(this.$circles).map((circle) =>
            circle.querySelectorAll('.js-slider-circleImage'),
        )

        this.index = 0
        this.scrollTimeout = 0
        this.canRender = true
        this.canScroll = true

        this.onResize()
        this.$container.addEventListener('wheel', this.onScroll.bind(this))
        window.addEventListener('resize', this.onResize.bind(this))
        RafManager.addQueue(this.render.bind(this))

        this.onScrollCompleted()
    }

    onResize() {
        this.windowWidth = window.innerWidth
        this.windowHeight = window.innerHeight

        this.width = 0
        this.$items.forEach((item) => {
            this.width += item.offsetWidth
        })

        this.margin = (this.windowWidth - this.$items[0].offsetWidth) / 2
        this.min = -this.margin
        this.max = this.width + this.margin - this.windowWidth

        this.scrollEased = this.min
        this.scroll = this.min

        this.$items.forEach((item) => {
            item.style.transform = `translateX(${-this.scroll}px)`
        })
    }

    onScroll(e) {
        if (!this.canScroll) return false

        this.canRender = true
        this.scroll += e.deltaY

        clearTimeout(this.scrollTimeout)
        this.scrollTimeout = null
        this.scrollTimeout = setTimeout(() => this.onScrollCompleted(), 100)
    }

    onScrollCompleted() {
        this.canScroll = false
        this.index = this.getActiveItem()
        this.slideToItem(this.index)
        this.changeCircles()
    }

    getItemPosition(index) {
        let x = -this.margin
        const length = this.$items.length

        for (let i = 0; i < length; i++) {
            if (i >= index) return x
            x += this.$items[i].offsetWidth
        }
    }

    getActiveItem() {
        const centers = []
        const temp = []
        const length = this.$items.length

        for (let i = 0; i < length; i += 1) {
            const rect = this.$items[i].getBoundingClientRect()
            centers.push(rect.left + rect.width * 0.5)
            temp.push(rect.left + rect.width * 0.5)
        }

        const center = this.windowWidth * 0.5
        let closest = temp.sort(
            (a, b) => Math.abs(center - a) - Math.abs(center - b),
        )[0]

        for (let i = 0; i < length; i++) {
            const x = centers[i]
            if (x === closest) {
                return i
            }
        }

        return null
    }

    slideToItem(index) {
        this.scrollTo(this.getItemPosition(index))
    }

    scrollTo(x) {
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

    changeCircles() {
        const duration = 1000
        const easing = 'easeInOutExpo'

        this.$circles.forEach((targets) => {
            const translateY = rand(-50, 50) + 'vh'
            const translateX = rand(-50, 50) + 'vw'
            const scale = randFloat(0.8, 1.2)
            anime({ targets, duration, easing, translateX, translateY, scale })
        })

        this.$circlesImages.map((circle) => {
            circle.forEach((image, index) => {
                if (index === this.index) {
                    image.style.opacity = 1
                } else {
                    image.style.opacity = 0
                }
            })
        })
    }

    render() {
        if (parseInt(this.scrollEased) === parseInt(this.scroll)) {
            this.canRender = false
        }

        if (!this.canRender) {
            document.body.classList.remove('is-sliding')
            return false
        }

        if (this.canRender && !document.body.classList.contains('is-sliding')) {
            document.body.classList.add('is-sliding')
        }

        if (this.scroll < this.min) {
            this.scroll += (this.min - this.scroll) * 0.1
        }

        if (this.scroll > this.max) {
            this.scroll += (this.max - this.scroll) * 0.1
        }

        this.scrollEased += (this.scroll - this.scroll) * 0.1

        this.$items.forEach((item) => {
            item.style.transform = `translateX(${-this.scroll}px)`
        })

        const r = range(this.scroll, this.min, this.max)
        this.$circlesDiv.style.transform = `translateX(${-r * 0.05}%)`
    }

    destroy() {}
}
