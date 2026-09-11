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

The theme-root `llms.txt` is the maintained source for the live site's AI discovery guide. Deploy a copy to the site's document root, or configure the web server to serve this file at `https://greenzeta.com/llms.txt` as UTF-8 plain text. Uploading the theme alone does not create that root URL. After deployment, verify that the URL returns HTTP 200 and the file contents rather than an HTML page.

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
- No build or test commands are configured.
- If tooling is added, document commands in `AGENTS.md` and update this README.
