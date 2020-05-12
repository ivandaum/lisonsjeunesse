import Highway from '@dogstudio/highway'
import { isFunction } from '../functions'
import InfiniteLoading from '../tools/InfiniteLoading'

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
        new InfiniteLoading()
    }
}

export default DefaultRenderer
