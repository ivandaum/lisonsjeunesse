import anime from 'animejs';
import Ajax from '../utils/Ajax';
import DomCreator from '../utils/DomCreator';

export default class Newsletter {
  constructor({ $container }) {
    this.$container = $container;
    this.$form = $container.querySelector('.js-form');

    this.STEP_1 = 'password';
    this.STEP_2 = 'subscribe';
    this.step = this.STEP_1;

    this.$form.addEventListener('submit', this.onSubmit.bind(this));
  }

  onSubmit(e) {
    e.preventDefault();

    const data = new FormData(this.$form);
    data.append('action', 'submitNewsletter');
    data.append('step', this.step);

    const request = new Ajax(window.ajaxUrl, data);
    request.then((response) => this.processResponse(response));
  }

  processResponse(response) {
    if (response.step === this.STEP_1) {
      if (response.success) {
        this.fadeForm(() => {
          this.$form.innerHTML = response.html;
        });
        this.step = this.STEP_2;
      } else {
        this.errorForm();
        const alert = DomCreator.alert('Mot de passe erroné ❌');
        document.body.appendChild(alert);
        DomCreator.removeAfter(alert, 3);
      }
      return true;
    }

    if (response.step === this.STEP_2) {
      if (response.success) {
        const alert = DomCreator.alert('Email envoyé 📭');
        document.body.appendChild(alert);
        DomCreator.removeAfter(alert, 3);
        this.successForm();
        this.$form.reset();
      } else {
        this.errorForm();
        const alert = DomCreator.alert('Adresse email non valide ❌');
        document.body.appendChild(alert);
        DomCreator.removeAfter(alert, 3);
      }
      return true;
    }

    this.errorForm();
    const alert = DomCreator.alert('Erreur inconnue. Contactez un administrateur. ❌');
    document.body.appendChild(alert);
    DomCreator.removeAfter(alert, 3);
    return false;
  }

  errorForm() {
    const timeline = anime.timeline({ autoplay: false });
    const duration = 1000;
    const easing = 'easeInOutQuart';
    const targets = this.$form.querySelector('input');

    timeline.add({
      targets,
      background: ['rgba(255, 0, 0, 0)', 'rgba(255, 0, 0, 1)'],
      easing,
      duration,
    })
      .add({
        targets,
        background: ['rgba(255, 0, 0, 1)', 'rgba(255, 0, 0, 0)'],
        easing,
        duration,
      });

    timeline.play();
  }

  successForm() {
    const timeline = anime.timeline({ autoplay: false });
    const duration = 1000;
    const easing = 'easeInOutQuart';
    const targets = this.$form.querySelector('input');

    timeline.add({
      targets,
      background: ['rgba(0, 255, 0, 0)', 'rgba(0, 255, 0, 1)'],
      easing,
      duration,
    })
      .add({
        targets,
        background: ['rgba(0, 255, 0, 1)', 'rgba(0, 255, 0, 0)'],
        easing,
        duration,
      });

    timeline.play();
  }

  fadeForm(doInMiddle) {
    const timeline = anime.timeline({ autoplay: false });
    const duration = 500;
    const easing = 'easeInOutQuart';
    const targets = this.$form;

    timeline.add({
      targets,
      opacity: [1, 0],
      easing,
      duration,
    })
      .add({
        targets,
        duration: 0,
        complete: () => doInMiddle(),
      })
      .add({
        targets,
        opacity: [0, 1],
        easing,
        duration,
      });

    timeline.play();
  }
}
