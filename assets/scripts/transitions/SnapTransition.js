import Highway from '@dogstudio/highway'
import { isFunction } from '../functions'

import PageBehavior from './PageBehavior'

class SnapTransition extends Highway.Transition {
    in({ from, done }) {
        from.remove()
        done()
    }

    out({ done }) {
        done()
    }
}

export default SnapTransition
