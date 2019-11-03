require('./bootstrap');
import Hammer from 'hammerjs';

let scrollMessagesWrapper = () => {
    let el = document.getElementById('messagesWrapper');
    if (!el) return;

    let scrollHeight = el.scrollHeight;
    el.scroll({
        top: scrollHeight,
        behavior: 'smooth'
    })
};
let showNotification = (name, text) => {
    if (Notification.permission === 'granted' && document.hidden) {
        let n = new Notification(`${name} wrote:`, {
            body: text
        })
    }
};

class Drawer {

    constructor(el) {
        this.openClass = 'open';
        this.el = el

        return this;
    }

    open() {
        this.el.classList.add('open')
    }

    close() {
        this.el.classList.remove('open')
    }

    toggle() {
        this.el.classList.toggle('open')
    }

    isOpen() {
        return this.el.classList.contains('open')
    }

    contains(target) {
        return this.el.contains(target)
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    (() => {
        window.drawer = new Drawer(document.getElementsByClassName('drawer')[0])
        window.burger = document.getElementById('burgerButton');
        let messagesSwipeManager = new Hammer.Manager(document.getElementById('messagesWrapper'));
        let OpenDrawerSwipe = new Hammer.Swipe();
        messagesSwipeManager.add(OpenDrawerSwipe);
        messagesSwipeManager.on('swiperight', (e) => {
            drawer.open()
        })
        messagesSwipeManager.on('swipeleft', (e) => {
            drawer.close()
        })
        document.addEventListener('click', e => {
            if (drawer.isOpen() && (!drawer.contains(e.target) && !burger.contains(e.target))) {
                drawer.close()
            }
        });
        scrollMessagesWrapper();
        Notification.requestPermission();
    })();
})


