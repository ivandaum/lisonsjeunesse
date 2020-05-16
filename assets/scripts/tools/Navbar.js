const OPEN_CLASS = 'is-search'
const MENU_CLASS = 'is-menu'

export default class Navbar {
    constructor() {
        this.$overlay = document.querySelector('.js-nav-search')
        this.$search = document.querySelector('.js-search')
        this.$close = document.querySelector('.js-close-search')
        this.$phoneBtn = document.querySelector('.js-phone-menu-btn')

        this.menuIsOpen = false

        this.$search.addEventListener('click', () => {
            document.body.classList.add(OPEN_CLASS)
            const input = this.$overlay.querySelector('input')
            if (input) input.focus()
        })

        this.$close.addEventListener('click', () =>
            document.body.classList.remove(OPEN_CLASS),
        )

        this.$phoneBtn.addEventListener('click', () => {
            document.body.classList.toggle(MENU_CLASS)
        })
    }

    show() {}
}
