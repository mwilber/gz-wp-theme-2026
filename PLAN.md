# Theme Implementation Plan (GreenZeta 2026)

## 1) Audit & Baseline
- Review current scaffold (`style.css`, `functions.php`, `header.php`, `footer.php`, `index.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`).
- Confirm required template hierarchy for the mockup: likely `front-page.php` (marketing landing), `home.php` (posts index), and `template-parts/` for reusable cards.
- Decide on asset layout: `assets/css/`, `assets/js/`, `assets/images/`, `template-parts/`.

## 2) Layout System & Responsive Strategy
- Implement a mobile-first layout with a `max-width: 1200px` content wrapper and full-width header/backgrounds.
- Define breakpoints for portrait mobile, tablet, desktop, and widescreen; keep components fluid (flex/grid).
- Ensure the hero card, social buttons, and card grid adapt gracefully (single column → multi-column).

## 3) WordPress Best Practices Integration
- Register menus (primary + optional secondary) and output with `wp_nav_menu()` in `header.php`.
- Add theme supports (`title-tag`, `post-thumbnails`, `html5`, `custom-logo`) and image sizes in `functions.php`.
- Introduce `theme.json` for typography, spacing, and color variables while keeping CSS minimal and semantic.
- Use template parts for card modules and navigation; keep content powered by WordPress loops.

## 4) Template Build-Out
- Create `front-page.php` to mirror the hero + card grid layout.
- Create `home.php` (posts index) and ensure archive/search layouts match the card system.
- Add `template-parts/hero.php`, `template-parts/card.php`, and `template-parts/navigation.php`.

## 5) Styling & Accessibility (No Content Hardcoding)
- Translate the mockup into CSS using variables and structural classes only; content comes from WP admin.
- Keep typography, spacing, and contrast accessible (WCAG AA where possible).
- Ensure nav is keyboard accessible, add visible focus styles, and keep ARIA minimal and correct.

## 6) Performance & QA
- Optimize images via WordPress sizes; avoid inline base64.
- Verify layouts at common widths (360, 768, 1024, 1200, 1440+).
- Validate that the main content never exceeds 1200px while backgrounds remain full-width.

## 7) Documentation & Handoff
- Update `AGENTS.md` with any new build commands or file structure.
- Document any theme options, menus, or widget areas in a short README update.
