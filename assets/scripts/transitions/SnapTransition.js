import Highway from '@dogstudio/highway'

class SnapTransition extends Highway.Transition {
    in({ from, done }) {
        document.body.classList.remove('fade-posts')
        from.remove()
        done()
    }

    out({ done }) {
        document.body.classList.add('fade-posts')
        done()
    }
}

export default SnapTransition
