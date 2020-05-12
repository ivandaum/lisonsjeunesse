const OPEN_CLASS = 'is-search'

export default class Navbar {
    constructor() {
        this.$overlay = document.querySelector('.js-nav-search')
        this.$search = document.querySelector('.js-search')
        this.$close = document.querySelector('.js-close-search')

        this.$search.addEventListener('click', () => {
            document.body.classList.add(OPEN_CLASS)
            const input = this.$overlay.querySelector('input')
            if (input) input.focus()
        })

        this.$close.addEventListener('click', () =>
            document.body.classList.remove(OPEN_CLASS),
        )
    }

    show() {}
}
