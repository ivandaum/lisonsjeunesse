// Allow to generate DOM element on the fly
// Use the removeAfter() to remove element after a short time

const DomCreator = {
  alert(string, classList) {
    const div = document.createElement('div');

    div.classList.add('alert', 'is-size-6');

    if (classList) {
      div.classList.add(classList);
    }

    div.innerHTML = string;
    return div;
  },
  img(imgObject) {
    const image = new Image();
    image.onload = () => {
      image.isLoaded = true;
    };

    image.width = imgObject.width + 'px';
    image.height = imgObject.height + 'px';

    image.url = imgObject.url;
    return image;
  },
  span(string, classList) {
    const div = document.createElement('div');
    if (classList) {
      div.classList.add(classList);
    }

    div.innerHTML = string;
    return div;
  },
  symbol(string) {
    const div = document.createElement('div');
    div.classList.add('symbol');
    div.innerHTML = string;
    return div;
  },
  removeAfter($element, seconds) {
    const cd = seconds || 0;
    setTimeout(() => {
      $element.remove();
    }, cd * 1000);
  },
};

export default DomCreator;
