(function ($) {
  const metaBox = document.querySelector('.greenzeta-gallery-meta');
  if (!metaBox) {
    return;
  }

  const selectButton = metaBox.querySelector('.greenzeta-gallery-meta__select');
  const clearButton = metaBox.querySelector('.greenzeta-gallery-meta__clear');
  const preview = metaBox.querySelector('.greenzeta-gallery-meta__preview');
  const input = metaBox.querySelector('input[name="greenzeta_screen_shots"]');

  if (!selectButton || !clearButton || !preview || !input) {
    return;
  }

  let frame;

  const renderPreview = (attachments) => {
    if (!attachments.length) {
      preview.innerHTML = '<em>No screenshots selected.</em>';
      clearButton.style.display = 'none';
      return;
    }
    const html = attachments
      .map((attachment) => {
        const url = attachment.sizes?.thumbnail?.url || attachment.url;
        return `<img src="${url}" alt="" style="width: 80px; height: auto;" />`;
      })
      .join('');
    preview.innerHTML = html;
    clearButton.style.display = 'inline-block';
  };

  selectButton.addEventListener('click', (event) => {
    event.preventDefault();
    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: 'Select screenshots',
      button: { text: 'Use these images' },
      multiple: true,
    });

    frame.on('select', () => {
      const selection = frame.state().get('selection').toJSON();
      const ids = selection.map((attachment) => attachment.id);
      input.value = ids.join(',');
      renderPreview(selection);
    });

    frame.open();
  });

  clearButton.addEventListener('click', (event) => {
    event.preventDefault();
    input.value = '';
    renderPreview([]);
  });
})(jQuery);
