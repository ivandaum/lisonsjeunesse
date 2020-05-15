import Highway from '@dogstudio/highway'
import Lazyloading from '../vendor/Lazyloading'

class AboutRenderer extends Highway.Renderer {
    onLeave() {}
    onEnter() {}

    onEnterCompleted() {
        const $view = this.wrap

        this.index = 0
        this.$items = $view.querySelectorAll('.js-slider-item')

        this.Lazyloading = new Lazyloading({
            load_delay: 0,
            elements_selector: 'img, .lazy',
            use_native: false,
        })

        this.$arrow = $view.querySelectorAll('.js-slider-trigger')
        this.$arrow.forEach((el) =>
            el.addEventListener('click', () =>
                this.switchTo(this.index + parseInt(el.dataset.direction)),
            ),
        )
    }

    switchTo(index) {
        if (index < 0) index = this.$items.length - 1
        if (index >= this.$items.length) index = 0

        this.index = index

        this.$items.forEach((item, i) => {
            if (i !== this.index) {
                item.classList.remove('is-active')
            } else {
                item.classList.add('is-active')
            }
        })
    }
}

export default AboutRenderer
