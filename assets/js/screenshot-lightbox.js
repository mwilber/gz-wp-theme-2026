(() => {
  const lightbox = document.querySelector('.screenshot-lightbox');
  if (!lightbox) {
    return;
  }

  const image = lightbox.querySelector('.screenshot-lightbox__image');
  const closeButtons = lightbox.querySelectorAll('[data-lightbox-close]');
  const triggers = document.querySelectorAll('.screenshot-carousel__button');

  if (!image || !triggers.length) {
    return;
  }

  const openLightbox = (src) => {
    image.src = src;
    lightbox.classList.add('screenshot-lightbox--open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.classList.add('is-lightbox-open');
  };

  const closeLightbox = () => {
    lightbox.classList.remove('screenshot-lightbox--open');
    lightbox.setAttribute('aria-hidden', 'true');
    image.src = '';
    document.body.classList.remove('is-lightbox-open');
  };

  triggers.forEach((button) => {
    button.addEventListener('click', () => {
      const src = button.getAttribute('data-full');
      if (src) {
        openLightbox(src);
      }
    });
  });

  closeButtons.forEach((button) => {
    button.addEventListener('click', closeLightbox);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeLightbox();
    }
  });
})();
