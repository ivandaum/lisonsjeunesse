import '../styles/index.scss'

import Highway from '@dogstudio/highway'

// import store from './utils/store';
import DefaultRenderer from './renderer/DefaultRenderer'
import HomeRenderer from './renderer/HomeRenderer'
import AboutRenderer from './renderer/AboutRenderer'
import DefaultTransition from './transitions/DefaultTransition'
import MyLibrairy from './tools/MyLibrairy'
import Navbar from './tools/Navbar'

// import HomeTransition from './transitions/HomeTransition';
// import CompanyTransition from './transitions/CompanyTransition';
// import XpTransition from './transitions/XpTransition';

// store.setGlobalVars();
// window.addEventListener('resize', () => store.setGlobalVars());

const Librairy = new MyLibrairy()
const Nav = new Navbar()

const core = new Highway.Core({
    renderers: {
        category: DefaultRenderer,
        single: DefaultRenderer,
        page: DefaultRenderer,
        search: DefaultRenderer,
        home: HomeRenderer,
        about: AboutRenderer,
    },
    transitions: {
        home: DefaultTransition,
        default: DefaultTransition,
    },
})

Nav.show()

// NavbarBehavior.bind(document.querySelector('.js-navbar-btn'));
// NavbarBehavior.bindClosers();
// const navbarAnimation = NavbarBehavior.firstShow();

function detachFromCore() {
    const $elements = document.querySelectorAll('.js-detach-core')
    core.detach($elements)
}

detachFromCore()
core.on('NAVIGATE_OUT', () => {
    document.body.classList.add('loading')
})

core.on('NAVIGATE_END', () => {
    Librairy.bindButtons()
    detachFromCore()
})

core.on('NAVIGATE_IN', ({ to }) => {
    document.body.classList = to.page.body.classList
})

core.on('NAVIGATE_ERROR', ({ location }) => {
    window.location.href = location.href
})

// const trans = core.Helpers.transitions[core.properties.slug] || core.Helpers.transitions.default;
// trans.prototype.in({ to: document.querySelector('[data-router-view]:last-of-type'), done: () => setTimeout(() => navbarAnimation.play(), 1000) });
