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
  const root = document.documentElement;

  const applyTheme = (theme) => {
    root.classList.toggle('theme-light', theme === 'light');
    root.classList.toggle('theme-dark', theme === 'dark');
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

const setSeasonByDate = () => {
  const month = new Date().getMonth();
  let season = 'autumn';

  if (month <= 1 || month === 11) {
    season = 'winter';
  } else if (month >= 2 && month <= 4) {
    season = 'spring';
  } else if (month >= 5 && month <= 7) {
    season = 'summer';
  }

  window.setSeasonPalette(season);
};

window.setSeasonPalette = (season) => {
  const trimmed = typeof season === 'string' ? season.trim() : '';
  const allowed = new Set([ 'summer', 'autumn', 'winter', 'spring' ]);
  const root = document.documentElement;

  if (!trimmed || !allowed.has(trimmed)) {
    root.removeAttribute('data-season');
    return;
  }

  root.setAttribute('data-season', trimmed);
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', setSeasonByDate);
} else {
  setSeasonByDate();
}
