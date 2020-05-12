export const rand = (min, max) =>
    Math.floor(Math.random() * (max - min + 1) + min)

export const randFloat = (min, max) => Math.random() * (max - min) + min

export const range = (input, min, max) => ((input - min) * 100) / (max - min)

export const isFunction = (obj) =>
    obj && {}.toString.call(obj) === '[object Function]'

export function getTop($element) {
    const bodyRect = document.body.getBoundingClientRect()
    const elemRect = $element.getBoundingClientRect()

    return elemRect.top - bodyRect.top
}

export const observeVisibility = ($target, callback) => {
    const observer = new IntersectionObserver((changes) => {
        const [{ isIntersecting }] = changes
        callback(isIntersecting)
    })
    observer.observe($target)
}
