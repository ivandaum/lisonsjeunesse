import anime from 'animejs';
import { rand } from '../functions';

export default class RandomFacts {
  constructor({ $container }) {
    this.index = 0;
    this.isPlaying = false;

    this.$container = $container;
    this.$number = this.$container.querySelector('.js-random-number');
    this.$label = this.$container.querySelector('.js-random-label');
    this.$cursor = this.$container.querySelector('.js-random-cursor');

    this.onResize();

    this.cursorX = this.containerWidth * 0.25;
    this.cursorY = this.containerHeight * 0.75;
    this.moveButton(1);

    this.data = JSON.parse($container.dataset.facts);

    if (this.data) {
      this.$cursor.addEventListener('click', this.randomize.bind(this));
    }
  }

  onResize() {
    this.containerWidth = this.$container.offsetWidth;
    this.containerHeight = this.$container.offsetHeight;
  }

  randomize() {
    if (this.isPlaying) {
      return false;
    }

    this.isPlaying = true;
    const current = this.data[this.index];

    this.index = this.randIndexNot(this.index);

    const next = this.data[this.index];
    this.changeNumber(current, next);
    this.changeLabel(next.label);
    this.moveButton();

    return true;
  }

  // Static position to repositionize button
  // better than calculate, more control on where the button goes
  getPositions() {
    const w = this.containerWidth;
    const h = this.containerHeight;

    const positions = [
      [w * 0.2, h * 0.2],
      [w * 0.4, h * 0.2],
      [w * 0.6, h * 0.2],
      [w * 0.8, h * 0.2],

      [w * 0.2, h * 0.4],
      [w * 0.8, h * 0.4],

      [w * 0.2, h * 0.6],
      [w * 0.8, h * 0.6],

      [w * 0.2, h * 0.8],
      [w * 0.8, h * 0.8],
    ];

    return positions;
  }

  // Pick a random position and place the cursor
  moveButton(timing) {
    const duration = timing || 1250;
    const positions = this.getPositions();
    const p = positions[rand(0, positions.length - 1)];

    [this.cursorX, this.cursorY] = p;

    anime({
      targets: this.$cursor,
      duration,
      easing: 'easeOutExpo',
      translateX: this.cursorX,
      translateY: this.cursorY,
    });
  }

  
  changeNumber(current, next) {
    const duration = 1000;
    const number = [parseInt(current.number), parseInt(next.number)];
    const targets = { number: 0 };

    const timeline = anime.timeline({
      easing: 'easeInOutQuart',
    });

    timeline
      .add({
        targets,
        number,
        duration,
        update: () => {
          const v = targets.number;
          this.$number.innerHTML = Math.floor(v);
        },
      });
  }

  changeLabel(text) {
    const $current = this.$label.querySelector('div');
    const duration = 1000;

    const $next = $current.cloneNode();
    $next.innerHTML = text;
    this.$label.appendChild($next);

    const timeline = anime.timeline({
      easing: 'easeInOutQuart',
      complete: () => {
        $current.remove();
        this.isPlaying = false;
      },
    });

    timeline
      .add({
        targets: $current,
        translateY: ['0%', '-100%'],
        opacity: [1, 0],
        duration,
      })
      .add({
        targets: $next,
        translateY: ['100%', '0%'],
        opacity: [0, 1],
        duration,
      }, 0);
  }

  destroy() {
    this.$container.removeEventListener('click', this.randomize);
    this.$container.removeEventListener('mousemove', () => this.moveCursor);
  }

  randIndexNot(index) {
    let newIndex = rand(0, this.data.length - 1);
    if (newIndex === index) {
      newIndex = this.randIndexNot(index);
    }
    return newIndex;
  }
}
