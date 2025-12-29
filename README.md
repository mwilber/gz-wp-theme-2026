# GreenZeta 2026 WordPress Theme

Custom WordPress theme for GreenZeta 2026. The design target is the `design.png` mockup with a full-width header/background and a 1200px max-width content area. Content is managed via the WordPress admin (no hardcoded card copy).

## Project Structure
- Theme root: `wp-content/themes/greenzetatwentysix`
- Templates: `front-page.php`, `home.php`, `index.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`
- Template parts: `template-parts/` (`hero.php`, `card.php`, `content-page.php`, `content-single.php`, `content-none.php`)
- Assets: `assets/css/`, `assets/js/`, `assets/images/`
- Stylesheet: `style.css` (includes theme header + styles)
- Theme settings: `theme.json`

## Theme Features
- Custom logo support (falls back to site title)
- Primary and social menus
- Featured images with a `greenzeta-card` size
- Responsive card grid layout
- Accessibility basics: skip link + focus-visible styles

## Design & Layout Notes
- Official GreenZeta green: `#7bb951` (top nav)
- Main content max width: 1200px
- Header/footer and background are full-width
- Mobile-first layout with breakpoints at ~720px and ~1024px

## Populating Content via WordPress Admin
1) Assign the theme
- Go to `Appearance → Themes` and activate “GreenZeta 2026.”

2) Set the site title and tagline (hero content)
- Go to `Settings → General` and update “Site Title” and “Tagline.”
- These appear in the hero section and post index header.

3) Configure the homepage
- Go to `Settings → Reading`.
- Choose:
  - “Your latest posts” to use the posts grid on the front page, or
  - “A static page” to set a custom front page (still using the theme layout).

4) Add menu links
- Go to `Appearance → Menus`.
- Create a menu and assign it to “Primary.”
- Create a second menu and assign it to “Social” for the footer icons/links.

5) Add posts and featured images (cards)
- Go to `Posts → Add New`.
- Add a title and excerpt; the excerpt appears on the card.
- Set a Featured Image to display the card image.

6) Pages and single posts
- Pages use `page.php` with `template-parts/content-page.php`.
- Single posts use `single.php` with `template-parts/content-single.php`.

## Development Notes
- No build or test commands are configured yet.
- If you add tooling, document commands in `AGENTS.md` and update this README.
