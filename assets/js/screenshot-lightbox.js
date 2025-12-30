(() => {
  const lightbox = document.querySelector('.screenshot-lightbox');
  if (!lightbox) {
    return;
  }

  const image = lightbox.querySelector('.screenshot-lightbox__image');
  const video = lightbox.querySelector('.screenshot-lightbox__video');
  const closeButtons = lightbox.querySelectorAll('[data-lightbox-close]');
  const triggers = document.querySelectorAll('.screenshot-carousel__button');

  if (!image || !video || !triggers.length) {
    return;
  }

  const openLightbox = (type, src) => {
    if (type === 'video') {
      video.src = src;
      video.style.display = 'block';
      image.style.display = 'none';
      video.play().catch(() => {});
    } else {
      image.src = src;
      image.style.display = 'block';
      video.style.display = 'none';
    }
    lightbox.classList.add('screenshot-lightbox--open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.classList.add('is-lightbox-open');
  };

  const closeLightbox = () => {
    lightbox.classList.remove('screenshot-lightbox--open');
    lightbox.setAttribute('aria-hidden', 'true');
    image.src = '';
    video.pause();
    video.removeAttribute('src');
    video.load();
    document.body.classList.remove('is-lightbox-open');
  };

  triggers.forEach((button) => {
    button.addEventListener('click', () => {
      const videoSrc = button.getAttribute('data-video');
      const imageSrc = button.getAttribute('data-full');
      if (videoSrc) {
        openLightbox('video', videoSrc);
      } else if (imageSrc) {
        openLightbox('image', imageSrc);
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
