import Cookies from 'js-cookie'

const COOKIE_NAME = 'librairy'
const ACTIVE_BTN = 'is-active'

export default class MyLibrairy {
    constructor() {
        this.$menuItem = document.querySelector('.js-librairy-pins')
        this.$link = document.querySelector('.js-biblioteque')
        this.bindButtons()
    }

    bindButtons() {
        this.$buttons = []
        this.$buttons = document.querySelectorAll('.js-add-to-librairy')
        this.$buttons.forEach((btn) =>
            btn.addEventListener('click', () => this.addToLibrairy(btn)),
        )
    }

    addToLibrairy(btn) {
        const id = btn.dataset.id
        let ids = Cookies.get(COOKIE_NAME)

        if (!ids) {
            ids = []
        } else {
            ids = JSON.parse(ids)
        }

        const index = ids.indexOf(id)
        if (index !== -1) {
            ids.splice(index, 1)
            btn.classList.remove(ACTIVE_BTN)
        } else {
            ids.push(id)
            btn.classList.add(ACTIVE_BTN)
        }

        const numberNavbar = ids.length ? ids.length : ''
        this.$menuItem.innerHTML = numberNavbar

        const url = this.$link.href.split('?t')
        this.$link.href = url[0] + '?t=' + Date.now()

        Cookies.set(COOKIE_NAME, ids)
    }
}
