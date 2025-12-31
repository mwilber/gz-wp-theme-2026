(() => {
  const nav = document.querySelector('.site-nav');
  if (!nav) {
    return;
  }

  const toggle = nav.querySelector('.site-nav__toggle');
  const panel = nav.querySelector('.site-nav__panel');
  const themeToggle = nav.querySelector('.site-theme-toggle');

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

  if (!themeToggle) {
    return;
  }

  const themeKey = 'greenzeta-theme';
  const body = document.body;

  const applyTheme = (theme) => {
    body.classList.toggle('theme-light', theme === 'light');
    body.classList.toggle('theme-dark', theme === 'dark');
    themeToggle.setAttribute('aria-pressed', theme ? 'true' : 'false');

    if (!theme) {
      themeToggle.setAttribute('aria-label', 'Use dark theme');
      return;
    }

    themeToggle.setAttribute(
      'aria-label',
      theme === 'dark' ? 'Use light theme' : 'Use system theme'
    );
  };

  const getStoredTheme = () => {
    try {
      return window.localStorage.getItem(themeKey);
    } catch (error) {
      return null;
    }
  };

  const setStoredTheme = (theme) => {
    try {
      if (!theme) {
        window.localStorage.removeItem(themeKey);
        return;
      }
      window.localStorage.setItem(themeKey, theme);
    } catch (error) {
      // Ignore storage errors to keep defaults working.
    }
  };

  let currentTheme = getStoredTheme();
  applyTheme(currentTheme);

  themeToggle.addEventListener('click', () => {
    if (!currentTheme) {
      currentTheme = 'dark';
    } else if (currentTheme === 'dark') {
      currentTheme = 'light';
    } else {
      currentTheme = null;
    }

    setStoredTheme(currentTheme);
    applyTheme(currentTheme);
  });
})();

window.setSeasonPalette = (season) => {
  const trimmed = typeof season === 'string' ? season.trim() : '';
  if (!trimmed) {
    document.documentElement.removeAttribute('data-season');
    return;
  }

  document.documentElement.setAttribute('data-season', trimmed);
};
