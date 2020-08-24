import { isFunction } from '../functions'
const duration = 1000

const PageBehavior = {
    show({ to, from, done }) {
        to.style.opacity = 0
        from.style = 'position: absolute; left: 0; top: 0; width: 100%;'
        const target = document.querySelector('.js-loader')
        target.style.opacity = 1

        setTimeout(() => {
            window.scrollTo(0, 0)
            to.style = ''
            if (from) {
                from.remove()
            }
        }, duration * 0.5)

        setTimeout(() => {
            target.style.opacity = 0
            document.body.classList.remove('loading')

            if (done && isFunction(done)) {
                done()
            }
        }, duration)
    },

    hide({ done }) {
        if (done && isFunction(done)) {
            done()
        }
    },
}

export default PageBehavior
