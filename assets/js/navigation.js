(() => {
  const nav = document.querySelector('.site-nav');
  if (!nav) {
    return;
  }

  const toggle = nav.querySelector('.site-nav__toggle');
  const panel = nav.querySelector('.site-nav__panel');

  if (!toggle || !panel) {
    return;
  }

  const setOpen = (isOpen) => {
    nav.classList.toggle('site-nav--open', isOpen);
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
  };

  setOpen(false);

  toggle.addEventListener('click', () => {
    const isOpen = nav.classList.contains('site-nav--open');
    setOpen(!isOpen);
  });

  panel.addEventListener('click', (event) => {
    if (event.target.closest('a')) {
      setOpen(false);
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      setOpen(false);
    }
  });
})();
