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
        this.el = document.querySelector(`div.drawer[data-drawer="${el}"]`);
        document.addEventListener('click', e => {
            if (this.shouldCloseOnClick(e)) {
                drawer.close()
            }
        });
        this.initSwipeEvents()
        return this;
    }

    initSwipeEvents() {
        let messagesSwipeManager = new Hammer.Manager(document.querySelector('div#messagesWrapper'));
        let OpenDrawerSwipe = new Hammer.Swipe({direction: Hammer.DIRECTION_RIGHT});
        messagesSwipeManager.add(OpenDrawerSwipe);
        messagesSwipeManager.on('swipe', () => this.open())
    }

    open() {
        this.el.classList.add('open')
        this.addOverlay()
    }

    close() {
        this.el.classList.remove('open')
        this.removeOverlay()
    }

    shouldCloseOnClick(e) {
        return this.isOpen() &&
            (!this.el.contains(e.target) && !e.target.classList.contains('drawer-trigger')
                || e.target.classList.contains('drawer-overlay'))
    }

    addOverlay() {
        let overlay = document.createElement('div')
        overlay.classList.add("drawer-overlay", "absolute", "inset-0", "bg-black", "opacity-50", "z-10")
        document.querySelector('body').insertBefore(overlay, document.body.firstChild)

        let CloseDrawerSwipe = new Hammer.Swipe({direction: Hammer.DIRECTION_LEFT});
        let drawerSwipeManager = new Hammer.Manager(document.querySelector('div.drawer-overlay'));
        drawerSwipeManager.add(CloseDrawerSwipe)
        drawerSwipeManager.on('swipe', () => this.close())
    }

    removeOverlay() {
        let overlay = document.querySelector('body>div.drawer-overlay');
        if (overlay) {
            overlay.remove()
        }
    }

    toggle() {
        if (this.isOpen()) {
            this.close()
        } else {
            this.open()
        }
    }

    isOpen() {
        return this.el.classList.contains('open')
    }

    contains(target) {
        return this.el.contains(target)
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    window.drawer = new Drawer('users')
    window.burger = document.getElementById('burgerButton');
    scrollMessagesWrapper();
    Notification.requestPermission();
})


