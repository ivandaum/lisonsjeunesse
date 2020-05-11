const OPEN_CLASS = 'is-search'

export default class Navbar {
    constructor() {
        this.$nav = document.querySelector('.js-nav')
        this.$search = document.querySelector('.js-search')
        this.$close = document.querySelector('.js-close-search')

        this.$search.addEventListener('click', () =>
            document.body.classList.add(OPEN_CLASS),
        )

        this.$close.addEventListener('click', () =>
            document.body.classList.remove(OPEN_CLASS),
        )
    }

    show() {}
}
