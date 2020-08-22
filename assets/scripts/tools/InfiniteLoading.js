import Lazyloading from '../vendor/Lazyloading'

import { post } from '../utils/Ajax'
export default class InfiniteLoading {
    constructor() {
        this.canLoad = true
        this.isFirstLoad = true

        this.bind()
        this.Lazyloading = new Lazyloading({
            load_delay: 10,
            elements_selector: 'img:not(.loaded)',
            use_native: false,
        })
    }

    loadImage() {
        this.Lazyloading.update()
    }

    bind() {
        this.$btn = document.querySelector('.js-infinite-load-btn')
        this.$limit = document.querySelector('.js-ajax-preload')
        this.$container = document.querySelector('.js-posts')

        if (this.$btn) {
            this.$btn.addEventListener('click', (e) => {
                e.preventDefault()
                this.$btn.classList.add('loading')
                this.$btn.style = 'pointer-events: none'
                this.load()
            })
        }
    }

    bindAutoLoad() {
        const observer = new IntersectionObserver(
            (changes) => {
                const [{ isIntersecting }] = changes
                if (isIntersecting) this.load()
            },
            {
                threshold: [0.1],
            },
        )
        observer.observe(this.$limit)
    }

    async load() {
        if (!this.canLoad) return false

        const url = window.ajaxUrl
        const dataset = JSON.parse(this.$btn.dataset.ajax)

        const params = new FormData()
        params.append('action', 'load_posts')

        for (const name in dataset) {
            params.append(name, dataset[name])
        }

        try {
            const resp = await post({ url, params })
            console.log(resp)
            const data = JSON.parse(resp.data)

            dataset.page += 1
            this.$btn.dataset.ajax = JSON.stringify(dataset)

            this.$container.innerHTML += data.html
            this.loadImage()

            if (this.isFirstLoad) {
                this.bindAutoLoad()
                this.isFirstLoad = false
            }

            this.canLoad = data.loadMore
            if (!this.canLoad) {
                this.$btn.remove()
            }
        } catch (e) {
            console.log(new Error(e))
        }
    }
}
