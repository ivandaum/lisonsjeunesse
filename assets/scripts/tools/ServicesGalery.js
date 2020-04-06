// import anime from 'animejs';
import RafManager from '../utils/RafManager';

export default class ServicesGalery {
  constructor({ $container }) {
    this.$container = $container;
    this.opacities = [];
    this.$galeriesImages = [];

    this.$triggers = this.$container.querySelectorAll('.js-services-galeryTrigger');
    this.$galeries = this.$container.querySelectorAll('.js-services-images');
    this.$galeries.forEach(($galery) => {
      this.opacities.push(0);
      this.$galeriesImages.push($galery.querySelectorAll('picture'));
    });

    if (window.innerWidth <= 768) {
      return false;
    }

    this.onResize();

    this.progressionIndex = 0;
    this.currentImage = 0;
    this.currentGalery = null;

    this.cursorX = this.containerWidth * 0.5;
    this.cursorY = 0;
    this.cursorPosition = [this.cursorX, this.cursorY];

    this.$triggers.forEach(($trigger, index) => {
      $trigger.addEventListener('mouseenter', () => {
        this.currentGalery = index;
      });
      $trigger.addEventListener('mouseleave', () => {
        this.currentGalery = null;
        this.progressionIndex = 0;
        this.currentImage = 0;
      });
    });

    this.$container.addEventListener('mousemove', (e) => this.moveCursor(e));

    RafManager.addQueue(this.render.bind(this));

    return true;
  }

  moveCursor(e) {
    const rect = this.$container.getBoundingClientRect();
    this.cursorX = e.x - rect.x;
    this.cursorY = e.y - rect.y;

    if (this.currentGalery !== null) {
      this.progressionIndex += 0.03;

      if (this.progressionIndex > this.$galeriesImages[this.currentGalery].length) {
        this.progressionIndex = 0;
      }

      const imageIndex = Math.floor(this.progressionIndex);
      this.currentImage = imageIndex;
    }
  }

  onResize() {
    this.containerWidth = this.$container.offsetWidth;
    this.containerHeight = this.$container.offsetHeight;
  }

  render() {
    this.onResize();

    this.cursorPosition[0] += (this.cursorX - this.cursorPosition[0]) * 0.1;
    this.cursorPosition[1] += (this.cursorY - this.cursorPosition[1]) * 0.1;

    for (let a = 0; a < this.$galeries.length; a += 1) {
      this.opacities[a] += ((a === this.currentGalery ? 1 : 0) - this.opacities[a]) * 0.1;
      this.$galeries[a].style.transform = `translate(${this.cursorPosition[0]}px, ${this.cursorPosition[1]}px) scale(${this.opacities[a]})`;

      if (this.currentGalery === a) {
        const images = this.$galeriesImages[a];
        for (let i = 0; i < images.length; i += 1) {
          images[i].style.opacity = (this.currentImage === i) ? 1 : 0;
        }
      }
    }
  }

  destroy() {
    this.$triggers.forEach(($trigger) => {
      $trigger.removeEventListener('mouseenter', () => {});
      $trigger.removeEventListener('mouseleave', () => {});
    });
    this.$container.removeEventListener('mousemove', () => {});
  }
}
