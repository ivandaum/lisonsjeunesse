// import animejs from 'animejs';

/**
 * The slider is specific to a lot of modules
 * it will search for all .js-slider in page
 * 
 * Example : 
 * <div class="js-slider">
 * ...
 *    <div class="js-slider-activable">
 *    ...
 *    </div>
 *    <button class="js-slider-activable js-slider-trigger">...</butto>
 * 
 * - The slider will add an ".active" class to all "js-slider-activable"
 * - The triggers can be multiple ".js-slider-trigger", or multiples ".js-slider-next" (will jump to next index) 
 * 
 * 
 * OPTIONS :
 * - The ".js-slider-trigger" can have the ".js-slider-toggle" class (will allow to toggle the element)
 * - the ".js-slider-activable"  can have the ".js-slider-expand" class (on open, the element will have its height calculate and added inline)
 */
export default class Slider {
  constructor({ $container }) {
    this.index = 0;
    this.activeClass = 'active';
    this.expandClass = 'js-slider-expand';

    this.$container = $container;
    this.$activables = Array.from(this.$container.querySelectorAll('.js-slider-activable'));
    this.$triggers = Array.from(this.$container.querySelectorAll('.js-slider-trigger'));
    this.$next = Array.from(this.$container.querySelectorAll('.js-slider-next'));

    this.$triggers.map(($trigger, index) => $trigger.addEventListener('click', () => this.switch(index, $trigger)));
    this.$next.map(($trigger) => $trigger.addEventListener('click', () => this.next($trigger)));
  }

  switch(index, $trigger) {
    if (index === this.index && $trigger.classList.contains('js-slider-toggle')) {
      return this.closeAll();
    }

    if (this.index === index) {
      return false;
    }

    this.closeAll();
    this.open(index);
    this.index = index;

    return true;
  }

  next($trigger) {
    const count = parseInt($trigger.dataset.count) - 1;
    const index = this.index + 1 > count ? 0 : this.index + 1;

    this.closeAll();
    this.open(index);
    this.index = index;
  }

  open(index) {
    const elements = this.getActivablesByIndex(index);
    elements.map((el) => {
      el.classList.add(this.activeClass);

      // if element need to have a height calculated
      if (el.classList.contains(this.expandClass)) {
        // eslint-disable-next-line
        el.style.height = this.getChildTotalHeight(el) + 'px';
      }

      return true;
    });
  }

  closeAll() {
    this.$activables.map(($activable) => {
      $activable.classList.remove(this.activeClass);

      // if element need to have a height removed
      if ($activable.classList.contains(this.expandClass)) {
        // eslint-disable-next-line
        $activable.style.height = '';
      }

      return true;
    });

    this.index = null;
  }

  getActivablesByIndex(index) {
    const elements = [];

    this.$activables.map(($activable) => {
      const ind = parseInt($activable.dataset.index);
      if (ind === index) {
        elements.push($activable);
      }

      return true;
    });

    return elements;
  }

  getChildTotalHeight(el) {
    let height = 0;
    for (let i = 0; i < el.childNodes.length; i += 1) {
      const child = el.childNodes[i];
      if (child.offsetHeight) {
        height += child.offsetHeight;
      }
    }
    return height;
  }

  destroy() {
    this.$triggers.map(($trigger) => $trigger.removeEventListener('click', () => {}));
    this.$next.map(($trigger) => $trigger.removeEventListener('click', this.next));
  }
}
