import '../styles/index.scss'

import Highway from '@dogstudio/highway'

// import store from './utils/store';
import DefaultRenderer from './renderer/DefaultRenderer'
import DefaultTransition from './transitions/DefaultTransition'
// import NavbarBehavior from './transitions/NavbarBehavior';

// import HomeTransition from './transitions/HomeTransition';
// import CompanyTransition from './transitions/CompanyTransition';
// import XpTransition from './transitions/XpTransition';

// store.setGlobalVars();
// window.addEventListener('resize', () => store.setGlobalVars());

const core = new Highway.Core({
    renderers: {
        category: DefaultRenderer,
    },
    transitions: {
        default: DefaultTransition,
    },
})

// NavbarBehavior.bind(document.querySelector('.js-navbar-btn'));
// NavbarBehavior.bindClosers();
// const navbarAnimation = NavbarBehavior.firstShow();

core.on('NAVIGATE_OUT', () => {
    document.body.classList.add('loading')
})

// core.detach(document.querySelectorAll('a[href^="mailto"'));
// core.on('NAVIGATE_END', () => {
//   core.detach(document.querySelectorAll('a[href^="mailto"'));
// });

// core.on('NAVIGATE_IN', ({ location }) => {})

core.on('NAVIGATE_ERROR', ({ location }) => {
    window.location.href = location.href
})

// const trans = core.Helpers.transitions[core.properties.slug] || core.Helpers.transitions.default;
// trans.prototype.in({ to: document.querySelector('[data-router-view]:last-of-type'), done: () => setTimeout(() => navbarAnimation.play(), 1000) });
