# Repository Guidelines

## Project Structure & Module Organization
This repository is the “GreenZeta 2026” custom WordPress theme folder located under `wp-content/themes/greenzetatwentysix`. Theme files live at the repo root. Current templates include `front-page.php`, `home.php`, `index.php`, `page.php`, `single.php`, `archive.php`, `search.php`, and `404.php`, with `functions.php` for setup. Reusable pieces live in `template-parts/` (for example: `hero.php`, `card.php`, `content-page.php`, `content-single.php`, `content-none.php`), and static assets should go under `assets/` (for example: `assets/css/`, `assets/js/`, `assets/images/`). Update this guide as the structure evolves.

## Build, Test, and Development Commands
No build, lint, or test commands are defined in this repository yet. If you add tooling, document the exact commands here. Example format:
- `npm run build` — compile assets into `dist/`.
- `npm test` — run unit tests.
- `npm run lint` — run static analysis.

## Coding Style & Naming Conventions
No project-specific style rules are currently documented. If you introduce PHP/JS/CSS, add a formatter or linter and note its configuration (for example, a `.editorconfig`, ESLint, or Prettier). Use WordPress-friendly naming and file patterns. Example: `template-parts/header-site.php` for template parts, and `assets/css/theme.css` for compiled styles.

## Testing Guidelines
There are no tests or testing frameworks configured yet. If tests are added, document the framework (e.g., PHPUnit, Jest), naming conventions (e.g., `*Test.php`), and any coverage expectations.

## Design & Layout Requirements
The visual target is the `design.png` mockup. Content should come from WordPress admin fields; do not hardcode card content. Layout must be responsive from portrait mobile to widescreen desktop. The main content container should not exceed 1200px width, while background and navigation span the full browser width. The official GreenZeta green used in the top nav is `#7bb951`. No styling has been applied yet; keep future styles aligned with the mockup’s card-based layout.

## Current Implementation Notes
- Styles live in `style.css` and are enqueued in `functions.php` via `greenzeta_2026_enqueue_assets()`.\n- Menus: `primary` renders in `header.php`, `social` renders in `footer.php`.\n- Featured images are used in cards with the `greenzeta-card` size.\n- Theme settings live in `theme.json` (content size is 1200px).\n- The README includes current admin setup steps for content population.

## QA Checklist
- Verify layout at 360, 768, 1024, 1200, and 1440+ widths.
- Confirm the main content stays at 1200px max width while header/footer backgrounds remain full width.
- Ensure card grids wrap cleanly and featured images render with the `greenzeta-card` size.
- Check keyboard navigation (skip link, menu items, card links) for visible focus states.

## Commit & Pull Request Guidelines
Use commit messages in this format: one sentence describing the change, followed by a concise bullet list of high-level changes. Example:
`Add theme scaffold and guidelines`
`- add core templates`
`- document contributor rules`
For pull requests, include:
- A short description of the change and its intent.
- Links to related issues or tickets (if any).
- Screenshots or recordings for UI changes.

## Configuration & Environment Notes
This theme lives under `app/public/wp-content/themes/greenzetatwentysix`. If local setup requires specific WordPress versions, plugins, or environment variables, document them here. When adding theme setup, note any required features (e.g., custom post types, theme supports) and where they are registered (typically `functions.php`). The display name “GreenZeta 2026” should be set in `style.css` under the `Theme Name` header.
