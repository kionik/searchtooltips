export class Ykajax {
    constructor() {
        this.xhr = new XMLHttpRequest();
    }

    post(url, data, func) {
        this.xhr.open('POST', url, false);
        this.xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        this.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        let str = Object.entries(data).map(([key, val]) => `${key}=${val}`).join('&');
        this.xhr.send(str);
        this.xhr.onreadystatechange = this.getResponse(func);
    }

    get(url, func) {
        this.xhr.open('GET', url, false);
        this.xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        this.xhr.send();
        this.xhr.onreadystatechange = this.getResponse(func);
    }

    getResponse(callbackFunc) {
        if (this.xhr.readyState > 3 && this.xhr.status == 200) {
            callbackFunc(this.xhr.responseText);
        }
    }
}