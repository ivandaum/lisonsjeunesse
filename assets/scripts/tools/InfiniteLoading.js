import Lazyloading from '../vendor/Lazyloading'
import { observeVisibility } from '../functions'

import { post } from '../utils/Ajax'
export default class InfiniteLoading {
    constructor() {
        this.isLoading = false
        this.isFirstLoad = true

        this.loadImage()
        this.bind()
    }

    loadImage() {
        this.Lazyloading = new Lazyloading({
            load_delay: 10,
            elements_selector: 'img:not(.loaded)',
            use_native: false,
        })
    }

    bind() {
        this.$btn = document.querySelector('.js-infinite-load-btn')
        this.$container = document.querySelector('.js-posts')

        if (this.$btn) {
            this.$btn.addEventListener('click', (e) => {
                e.preventDefault()
                this.load()
            })
        }
    }

    bindAutoLoad() {
        this.$btn.style.display = 'none'
        observeVisibility(this.$btn, (visible) =>
            visible ? this.load() : null,
        )
    }

    async load() {
        if (this.isLoading) return

        this.isLoading = true
        const url = window.ajaxUrl
        const dataset = JSON.parse(this.$btn.dataset.ajax)

        const params = new FormData()
        params.append('action', 'load_posts')

        for (const name in dataset) {
            params.append(name, dataset[name])
        }

        try {
            const resp = await post({ url, params })
            const data = JSON.parse(resp.data)

            dataset.page += 1
            this.$btn.dataset.ajax = JSON.stringify(dataset)

            this.$container.innerHTML += data.html
            this.loadImage()

            if (this.isFirstLoad) {
                this.bindAutoLoad()
            }

            this.isLoading = false
            this.isFirstLoad = false
        } catch (e) {
            console.log(new Error(e))
        }
    }
}
