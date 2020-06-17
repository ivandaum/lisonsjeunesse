import { isFunction } from '../functions'
import anime from 'animejs'

const easing = 'easeInOutExpo'
const duration = 1000

const PageBehavior = {
    show({ from, done, to }) {
        window.scrollTo(0, 0)

        from.style = 'position: absolute; left: 0; top: 0; width: 100%;'

        const timeline = anime.timeline({
            complete: () => {
                document.body.classList.remove('loading')

                if (done && isFunction(done)) {
                    done()
                }

                if (from) {
                    from.remove()
                }
            },
        })

        const animations = [
            {
                targets: to,
                duration,
                easing,
                opacity: [0, 1],
                translateZ: 1,
                translateX: [100, 0],
                delay: duration * 0.5,
            },
            {
                targets: from,
                duration,
                easing,
                opacity: [1, 0],
                translateZ: 1,
                translateX: [0, -100],
            },
        ]

        animations.map((anime) => timeline.add(anime, 0))
    },

    hide({ done }) {
        if (done && isFunction(done)) {
            done()
        }
    },
}

export default PageBehavior
