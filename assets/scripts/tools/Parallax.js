import RafManager from '../utils/RafManager';
import { getTop, range, getCurrentScroll } from '../functions';
import store from '../utils/store';

/* eslint-disable */
/*
* Will bind every elements having '.js-parallax' class
* 
* BEFORE CUSTOMIZE :
* 
* Two entities in this parallax
* the scroll detection : where you have to scroll in your page to start and end the parallax effect
* the traveled area : the area the element will travel
*
* The maximum scroll area & scroll detection for the effect is :
* START DETECTION = <element's center> - (windowHeight * 25%)
* END DETECTION = <element's center> + (windowHeight * 25%)
*
* default :
* START PARALLAX = START DETECTION
* END PARALLAX = END DETECTION
*
* meaning that you have to scroll further than START to trigger the parallax start effect,
* and scroll further than END to end it.
*
* Customize the data-area to change the area traveled.
*
* CUSTOMIZATION:
* 
* @area : float
* The scroll detection WILL NOT be affected by data-area, only
* the amount of pixels traveled by the element changes.
*
* example:
* <div class="... js-parallax" data-area="0.5"></div>
*
* the element will travel only 50% of its original scroll effect, the new area traveled is : 
* STAT SCROLL = <element's center> - ( (windowHeight * 25%) * 0.5)
* END SCROLL = <element's center> + ( (windowHeight * 25%) * 0.5)
*
* We basicly reduce the area traveled by 50% in this example
*
* @axis: string (default === y)
* change parallax direction, values : 
* x : horizontal
* y : vertical (default value, can be ommited)
*/
/* eslint-enable */

export default class Parallax {
  constructor({ $elements }) {
    this.canRender = false;
    this.$elements = $elements || document.querySelectorAll('.js-parallax');
    this.getElementsOpt(this.$elements);
    this.raf = RafManager.addQueue(this.render.bind(this));
  }

  destroy() {
    RafManager.removeQueue(this.raf);
  }

  getElementsOpt($elements) {
    this.translatables = [];
    const height = store.windowHeight;
    const normalPath = store.windowHeight * 0.25;
    for (let i = 0; i < $elements.length; i += 1) {
      const $el = $elements[i];

      const center = getTop($el) + $el.offsetHeight * 0.5;
      const area = parseFloat($el.dataset.area) || 1;
      const axis = $el.dataset.axis || 'y';

      // area the scroll need to be to start parallax
      const scrollRange = [center - height, center + height];

      // area the element will move throught
      const startY = center - (normalPath * area);
      const endY = center + (normalPath * area);

      const scale = $el.dataset.scale || null;
      const easing = $el.dataset.easing || 0.8;
      const path = endY - Math.abs(startY);

      this.translatables.push({
        value: 0,
        scrollRange,
        path,
        area,
        easing,
        axis,
        scale,
      });

      if ($el.dataset.debug) {
        $el.id = 'item-' + startY + '-' + endY;
        console.log(this.translatables[this.translatables.length - 1]);
        this.addMaker(startY, 'green');
        this.addMaker(center, 'yellow');
        this.addMaker(endY);
      }
    }
  }

  render() {
    const len = this.translatables.length;
    const top = getCurrentScroll() + store.windowHeight * 0.5;
    for (let i = 0; i < len; i += 1) {
      const item = this.translatables[i];
      let percentInArea = range(top, item.scrollRange[0], item.scrollRange[1]) * 0.01;
      percentInArea = Math.max(0, Math.min(percentInArea, 1));

      const to = (percentInArea - 0.5) * item.path;
      item.value += (to - item.value) * item.easing;

      const translate = 'translate' + item.axis.toUpperCase() + `(${item.value}px)`;
      this.$elements[i].style.transform = translate;
    }
  }

  // Debug purpoose
  addMaker(at, c) {
    const color = c || 'red';
    const marker = document.createElement('div');
    marker.classList.add('marker');
    marker.style = `z-index: 9999; position: absolute; left: 0; top: ${at}px; height: 5px; background: ${color}; width: 50px;`;
    document.body.appendChild(marker);
  }
}
