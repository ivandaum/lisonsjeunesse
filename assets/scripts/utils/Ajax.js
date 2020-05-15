export const post = ({ url, params }) => {
    const http = new XMLHttpRequest()
    http.open('POST', url)

    const req = new window.Promise((resolve) => {
        http.onload = () =>
            resolve({
                status: http.status,
                statusText: http.statusText,
                data: http.responseText,
            })
        http.onerror = () =>
            Error({
                status: http.status,
                statusText: http.statusText,
                data: http.statusText,
            })
        http.send(params)
    })

    return req
}
