# Repository Guidelines

## Project Structure & Module Organization
This repository is the “GreenZeta 2026” custom WordPress theme folder located under `wp-content/themes/greenzetatwentysix`. Theme files live at the repo root. Typical core files include `style.css` (theme header), `functions.php` (theme setup), and template files like `index.php`, `single.php`, and `page.php`. If you add supporting code or assets, use clear subfolders (for example: `assets/` for CSS/JS/images and `template-parts/` for partial templates) and update this guide to match the actual structure.

## Build, Test, and Development Commands
No build, lint, or test commands are defined in this repository yet. If you add tooling, document the exact commands here. Example format:
- `npm run build` — compile assets into `dist/`.
- `npm test` — run unit tests.
- `npm run lint` — run static analysis.

## Coding Style & Naming Conventions
No project-specific style rules are currently documented. If you introduce PHP/JS/CSS, add a formatter or linter and note its configuration (for example, a `.editorconfig`, ESLint, or Prettier). Use WordPress-friendly naming and file patterns. Example: `template-parts/header-site.php` for template parts, and `assets/css/theme.css` for compiled styles.

## Testing Guidelines
There are no tests or testing frameworks configured yet. If tests are added, document the framework (e.g., PHPUnit, Jest), naming conventions (e.g., `*Test.php`), and any coverage expectations.

## Commit & Pull Request Guidelines
Git history only shows a single “first commit,” so no commit message convention is established. If you introduce one, document it here (for example, `type(scope): summary`).
For pull requests, include:
- A short description of the change and its intent.
- Links to related issues or tickets (if any).
- Screenshots or recordings for UI changes.

## Configuration & Environment Notes
This theme lives under `app/public/wp-content/themes/greenzetatwentysix`. If local setup requires specific WordPress versions, plugins, or environment variables, document them here. When adding theme setup, note any required features (e.g., custom post types, theme supports) and where they are registered (typically `functions.php`). The display name “GreenZeta 2026” should be set in `style.css` under the `Theme Name` header.
