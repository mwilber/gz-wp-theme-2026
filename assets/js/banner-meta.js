(function ($) {
  const metaBox = document.querySelector('.greenzeta-banner-meta');
  if (!metaBox) {
    return;
  }

  const selectButton = metaBox.querySelector('.greenzeta-banner-meta__select');
  const removeButton = metaBox.querySelector('.greenzeta-banner-meta__remove');
  const preview = metaBox.querySelector('.greenzeta-banner-meta__preview');
  const input = metaBox.querySelector('input[name="greenzeta_banner_id"]');

  if (!selectButton || !removeButton || !preview || !input) {
    return;
  }

  let frame;

  selectButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select banner image',
      button: { text: 'Use this image' },
      multiple: false,
    });

    frame.on('select', () => {
      const attachment = frame.state().get('selection').first().toJSON();
      if (!attachment) {
        return;
      }
      input.value = attachment.id;
      preview.innerHTML = `<img src="${attachment.sizes?.medium?.url || attachment.url}" alt="" style="max-width: 100%; height: auto;" />`;
      removeButton.style.display = 'inline-block';
    });

    frame.open();
  });

  removeButton.addEventListener('click', (event) => {
    event.preventDefault();
    input.value = '';
    preview.innerHTML = '<em>No banner selected.</em>';
    removeButton.style.display = 'none';
  });
})(jQuery);
