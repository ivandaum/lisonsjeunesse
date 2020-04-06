import Highway from '@dogstudio/highway'
import { isFunction } from '../functions'
import Lazyloading from '../vendor/Lazyloading'

class DefaultRenderer extends Highway.Renderer {
    onLeave() {
        this.destroyOnLeave.map((obj) => {
            if (obj && isFunction(obj.destroy)) {
                return obj.destroy()
            }

            return false
        })
    }

    onEnterCompleted() {
        // const $view = document.querySelector('[data-router-view]:last-of-type')
        this.destroyOnLeave = []

        this.Lazyloading = new Lazyloading({
            load_delay: 10,
            elements_selector: 'img, .lazy',
            use_native: false,
        })
    }
}

export default DefaultRenderer
