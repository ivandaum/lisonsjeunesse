import Highway from '@dogstudio/highway';
import anime from 'animejs';
import { isFunction } from '../functions';

import PageBehavior from './PageBehavior';

class DefaultTransition extends Highway.Transition {
  in({ from, to, done }) {
    const timeline = anime.timeline({
      easing: 'easeOutQuart',
      autoplay: false,
    });

    const duration = 750;

    const titles = to.querySelectorAll('.js-loadview-title, .js-loadview-title span');
    if (titles && titles.length) {
      timeline.add({
        targets: titles,
        opacity: [0, 1],
        duration,
        delay: anime.stagger(100),
      });
    }

    const shapes = to.querySelectorAll('.js-loadview-shape');
    if (shapes && shapes.length) {
      timeline.add({
        targets: shapes,
        scale: [1.1, 1],
        duration,
        opacity: {
          value: [0, 1],
          duration: 500,
        },
        delay: anime.stagger(150),
      }, duration * 0.5);
    }

    PageBehavior.show({
      to,
      from,
      done: () => {
        timeline.play();
        if (done && isFunction(done)) {
          done();
        }
      },
    });
  }

  out({ from, done }) {
    PageBehavior.hide({ from });
    done();
  }
}

export default DefaultTransition;
