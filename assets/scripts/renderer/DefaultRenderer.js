import Highway from '@dogstudio/highway';

import Slider from '../tools/Slider';
import Parallax from '../tools/Parallax';
import RandomFacts from '../tools/RandomFacts';
import Newsletter from '../tools/Newsletter';
import ServicesGalery from '../tools/ServicesGalery';
import Lazyloading from '../vendor/Lazyloading';

import { isFunction, animeOnEnter, copyToClipboard } from '../functions';
import { fade, slide } from '../transitions';
import DomCreator from '../utils/DomCreator';

class DefaultRenderer extends Highway.Renderer {
  onLeave() {
    this.destroyOnLeave.map((obj) => {
      if (obj && isFunction(obj.destroy)) {
        return obj.destroy();
      }

      return false;
    });
  }

  onEnterCompleted() {
    const $view = document.querySelector('[data-router-view]:last-of-type');
    this.destroyOnLeave = [];

    const slider = $view.querySelectorAll('.js-slider');
    if (slider && slider.length) {
      slider.forEach(($container) => {
        this.destroyOnLeave.push(new Slider({ $container }));
      });
    }

    const parallax = $view.querySelectorAll('.js-parallax');
    if (parallax && parallax.length) {
      this.destroyOnLeave.push(new Parallax({ $elements: parallax }));
    }

    const facts = $view.querySelectorAll('.js-random-facts');
    if (facts && facts.length) {
      facts.forEach(($container) => {
        this.destroyOnLeave.push(new RandomFacts({ $container }));
      });
    }

    const serviceGalery = $view.querySelectorAll('.js-services-galery');
    if (serviceGalery && serviceGalery.length) {
      serviceGalery.forEach(($container) => {
        this.destroyOnLeave.push(new ServicesGalery({ $container }));
      });
    }

    const slideAnimation = $view.querySelectorAll('.js-slide-on-enter');
    if (slideAnimation && slideAnimation.length) {
      slideAnimation.forEach(($container) => animeOnEnter($container, slide($container)));
    }

    const fadeAnimation = $view.querySelectorAll('.js-fade-on-enter');
    if (fadeAnimation && fadeAnimation.length) {
      fadeAnimation.forEach(($container) => animeOnEnter($container, fade($container)));
    }

    const newsletter = $view.querySelectorAll('.js-newsletter');
    if (newsletter && newsletter.length) {
      newsletter.forEach(($container) => {
        this.destroyOnLeave.push(new Newsletter({ $container }));
      });
    }

    // Will bind every mailto:... to copy in clipboard on clique
    // fallback to mailto if fails
    const emails = $view.querySelectorAll('a[href^="mailto:"');
    if (emails && emails.length) {
      emails.forEach((email) => {
        email.addEventListener('click', (e) => {
          e.preventDefault();
          copyToClipboard(email.href.replace('mailto:', ''));
          const alert = DomCreator.alert('Copiée dans le presse papier.');
          DomCreator.removeAfter(alert, 3);
          document.body.appendChild(alert);
        });
      });
    }

    this.Lazyloading = new Lazyloading({
      load_delay: 10,
      elements_selector: 'img, .lazy',
      use_native: false,
    });
  }
}

export default DefaultRenderer;
