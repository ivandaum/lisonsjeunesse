import { post } from '../utils/Ajax'

export default class InfiniteLoading {
    constructor() {
        this.bind()
    }

    bind() {
        this.$btn = document.querySelector('.js-infinite-load-btn')
        this.$btn.addEventListener('click', (e) => {
            e.preventDefault()
            this.load()
        })
    }

    async load() {
        const url = window.ajaxUrl
        let params = new FormData()
        params.append('action', 'loadPosts')
        try {
            const resp = await post({ url, params })
            console.log(resp)
        } catch (e) {
            console.log(new Error(e))
        }
    }
}
