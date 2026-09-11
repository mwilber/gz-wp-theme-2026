# GreenZeta 2026 Theme Overview

This project is an experiment in AI-driven development. It was written entirely by OpenAI Codex as a production-ready WordPress theme and its supporting UI behaviors.

## Snapshot
![GreenZeta 2026 screenshot](https://greenzeta.com/wp-content/uploads/2026/01/greenzeta-2026.local_-687x1024.png)

Direct link: https://greenzeta.com/wp-content/uploads/2026/01/greenzeta-2026.local_-687x1024.png

## Overview
This theme showcases a card-based WordPress layout with a full-width visual environment, a centered content column, responsive grids, and a polished header/footer experience. The goal is to explain how an AI-assisted workflow can deliver a cohesive, production-grade theme with custom content types, flexible cards, and integrated visual systems.

## Highlights
- Responsive card grid system with featured media and overlay titles.
- Hero panel with editable content and skill pills.
- Custom post types (Projects, Portfolio, Updates) with linked content relationships.
- Theme-driven visual background (cityscape + layered textures).
- Light/dark mode toggle with system-aware defaults.
- Seasonal palette system controlled by JavaScript (auto by month).

## Theme Structure
- Theme root: `wp-content/themes/greenzetatwentysix`
- Templates: `front-page.php`, `home.php`, `index.php`, `page.php`, `single.php`, `archive.php`, `search.php`, `404.php`
- Template parts: `template-parts/` (`hero.php`, `card.php`, `content-page.php`, `content-single.php`, `content-none.php`)
- Assets: `assets/css/`, `assets/js/`, `assets/images/`
- Stylesheet: `style.css`
- Theme settings: `theme.json`
- AI discovery guide: `llms.txt`, curated for hiring and professional expertise queries using live GreenZeta pages.

## Publishing llms.txt

The theme-root `llms.txt` is the maintained source for the live site's AI discovery guide. With this theme active, `functions.php` serves it at `https://greenzeta.com/llms.txt` as UTF-8 plain text, before WordPress renders a template or redirects a missing page. GET returns the file verbatim and HEAD returns headers only. No permalink reset or separate file copy is needed. Front-end pages include a `rel="describedby"` link to help agents discover the guide.

Deploy both `functions.php` and `llms.txt`, then purge any page/CDN cache for `/llms.txt` and cached HTML pages. Verify that `curl -i https://greenzeta.com/llms.txt` returns HTTP 200, `Content-Type: text/plain; charset=UTF-8`, and Markdown rather than an HTML page. If the web server returns its own 404 before WordPress runs, configure `/llms.txt` to use the WordPress front controller, or deploy a copy of the file to the document root. A physical document-root copy takes precedence over the theme endpoint and must be kept in sync.

The guide must be publicly readable without a login or bot challenge. Existing robots.txt rules and hosting bot controls still apply; llms.txt provides context and links but does not grant crawler access or guarantee an AI service will use it.

Keep its descriptions and links aligned with the live site when portfolio entries, articles, or projects change. Professional work belongs under `/portfolio/`; hobby work belongs under `/project/`.

## WordPress Setup (Quick)
1) Activate the theme
- `Appearance → Themes` → “GreenZeta 2026”

2) Configure home page
- `Settings → Reading`
- Use “Your latest posts” for the post grid, or choose a static front page

3) Menus
- `Appearance → Menus`
- Assign the “Primary” menu to the header
- Assign the “Social” menu for icon links in the hero/footer

4) Posts and media
- Add posts with Featured Images to populate cards

## Development Notes
- `php -l functions.php` checks PHP syntax; `.editorconfig` records the existing two-space PHP formatting.
- No build or automated test suite is configured.
- If tooling is added, document commands in `AGENTS.md` and update this README.
