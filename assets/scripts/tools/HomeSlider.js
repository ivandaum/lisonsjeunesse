import RafManager from '../utils/RafManager'
import { range } from '../functions'
import anime from 'animejs'

export default class HomeSlider {
    constructor() {
        this.$container = document.querySelector('.js-home-slider')
        this.$items = document.querySelectorAll('.js-home-slider-item')
        this.$circles = document.querySelectorAll('.js-home-slider-circle')
        this.$circleContainer = document.querySelector(
            '.js-home-slider-circle-container',
        )

        this.index = 0
        this.scrollTimeout = 0

        this.onResize()
        this.$container.addEventListener('wheel', this.onScroll.bind(this))
        window.addEventListener('resize', this.onResize.bind(this))
        RafManager.addQueue(this.render.bind(this))
    }

    onResize() {
        this.windowWidth = window.innerWidth

        this.width = 0
        this.$items.forEach((item) => {
            this.width += item.offsetWidth
        })

        const margin = (this.windowWidth - this.$items[0].offsetWidth) / 2
        this.min = -margin
        this.max = this.width + margin - this.windowWidth

        this.scrollEased = this.min
        this.scroll = this.min
    }

    onScroll(e) {
        this.scroll += e.deltaY

        clearTimeout(this.scrollTimeout)
        this.scrollTimeout = null
        this.scrollTimeout = setTimeout(() => this.onScrollCompleted(), 500)
    }

    onScrollCompleted() {
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

        centers.map((x, i) => {
            if (x === closest) {
                this.index = i
                return this.scrollTo(this.getItemOriginPosition(this.$items[i]))
            }
        })
    }

    getItemOriginPosition(refItem) {
        let x = -this.min
        const index = parseInt(refItem.dataset.index)
        this.$items.forEach((item, i) => {
            if (i <= index) {
                x += item.offsetWidth
            }
        })

        return x
    }

    scrollTo(x) {
        console.log(
            this.$items[this.index].querySelector('.js-home-category')
                .innerHTML,
        )
        this.scroll = x
        console.log(x)
        // const targets = { x: this.scroll }
        // anime({
        //     targets,
        //     x,
        //     update: () => {
        //         this.scroll = targets.x
        //     },
        //     duration: 1000,
        //     easing: 'easeInOutExpo',
        // })
    }

    render() {
        if (this.scroll < this.min) {
            this.scroll += (this.min - this.scroll) * 0.1
        }

        if (this.scroll > this.max) {
            this.scroll += (this.max - this.scroll) * 0.1
        }

        this.scrollEased += (this.scroll - this.scroll) * 0.5

        this.$items.forEach((item) => {
            item.style.transform = `translateX(${-this.scroll}px)`
        })

        const r = range(this.scroll, this.min, this.max)
        this.$circleContainer.style.transform = `translateX(${-r * 0.1}%)`
    }

    destroy() {}
}
