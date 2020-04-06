import anime from 'animejs'

export const rand = (min, max) =>
    Math.floor(Math.random() * (max - min + 1) + min)

export const randFloat = (min, max) => Math.random() * (max - min) + min

export const range = (input, min, max) => ((input - min) * 100) / (max - min)

export const lerp = (v0, v1, t) => (1 - t) * v0 + t * v1

export const shuffle = (a) => {
    for (let i = a.length; i; i--) {
        let j = Math.floor(Math.random() * i)
        ;[a[i - 1], a[j]] = [a[j], a[i - 1]]
    }
}

export const slugify = (string) =>
    string
        ? string
              .replace(/<(.*?)>/, '-')
              .toLowerCase()
              .replace(/ /g, '-')
              .replace(/[^\w-]+/g, '')
        : null

export const isFunction = (obj) =>
    obj && {}.toString.call(obj) === '[object Function]'

export const scrollTo = ({ $container, from }) => {
    const y = getTop($container) - 100
    const easing = 'easeInOutExpo'
    const duration = 1000
    const scroll = { y: from || getCurrentScroll() }
    anime({
        targets: scroll,
        y,
        duration,
        easing,
        update: () => window.scrollTo(0, scroll.y),
    })
}

export function getTop($element) {
    const bodyRect = document.body.getBoundingClientRect()
    const elemRect = $element.getBoundingClientRect()

    return elemRect.top - bodyRect.top
}

export const getCurrentScroll = () =>
    window.scrollY ||
    window.scrollTop ||
    window.pageYOffset ||
    document.getElementsByTagName('html')[0].scrollTop

/**
 * Copy a string to clipboard
 * @param  {String} string         The string to be copied to clipboard
 * @return {Boolean}               returns a boolean correspondent to the success of the copy operation.
 */
export function copyToClipboard(string) {
    let textarea
    let result

    try {
        textarea = document.createElement('textarea')
        textarea.setAttribute('readonly', true)
        textarea.setAttribute('contenteditable', true)
        textarea.style.position = 'fixed' // prevent scroll from jumping to the bottom when focus is set.
        textarea.value = string

        document.body.appendChild(textarea)

        textarea.focus()
        textarea.select()

        const range = document.createRange()
        range.selectNodeContents(textarea)

        const sel = window.getSelection()
        sel.removeAllRanges()
        sel.addRange(range)

        textarea.setSelectionRange(0, textarea.value.length)
        result = document.execCommand('copy')
    } catch (err) {
        console.error(err)
        result = null
    } finally {
        document.body.removeChild(textarea)
    }

    // manual copy fallback using prompt
    if (!result) {
        const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0
        const copyHotkey = isMac ? '⌘C' : 'CTRL+C'
        result = prompt(`Press ${copyHotkey}`, string) // eslint-disable-line no-alert
        if (!result) {
            return false
        }
    }
    return true
}

export const animeOnEnter = ($element, animation) => {
    if (isFunction(IntersectionObserver)) {
        const observer = new IntersectionObserver((changes) => {
            const [{ isIntersecting }] = changes

            if (isIntersecting && !animation.completed) {
                animation.play()
            }
        })
        observer.observe($element)
    } else {
        // fallback in case of no IntersectionObserver
        animation.play()
    }
}

export const konami = (callback) => {
    const k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65]
    let n = 0
    document.addEventListener('keydown', (e) => {
        if (e.keyCode === k[n++]) {
            if (n === k.length) {
                callback()
                n = 0
                return false
            }
        } else {
            n = 0
        }
    })
}
