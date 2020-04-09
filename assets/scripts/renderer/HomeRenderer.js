import Highway from '@dogstudio/highway'
import Lazyloading from '../vendor/Lazyloading'
import HomeSlider from '../tools/HomeSlider'

class HomeRenderer extends Highway.Renderer {
    onLeave() {
        if (this.slider) {
            this.slider.destroy()
        }
    }
    onEnter() {}

    onEnterCompleted() {
        this.slider = new HomeSlider()

        this.Lazyloading = new Lazyloading({
            load_delay: 500,
            elements_selector: 'img, .lazy',
            use_native: false,
        })
    }
}

export default HomeRenderer
