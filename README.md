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

## Deployment

`.github/workflows/deploy.yml` updates the existing DreamHost theme checkout over SSH on port 22. Configure these GitHub repository Actions secrets:

| Secret | Value |
| --- | --- |
| `DEPLOY_SSH_KEY` | Complete private key for Actions to log into DreamHost. |
| `DEPLOY_KNOWN_HOSTS` | Verified SSH known-hosts entry for the DreamHost server. |
| `DEPLOY_USER` | DreamHost SSH username. |
| `DEPLOY_DOMAIN` | SSH hostname only, without a URL scheme, username, port, or path. |
| `DEPLOY_PATH` | Existing theme repository checkout on the server, preferably an absolute path. A leading `~/` is also supported. |

The server checkout must already have an `origin` remote and unattended SSH access to fetch this GitHub repository, using its separate server-to-GitHub key.

Pushes to any branch containing the workflow deploy that branch to the same website. Tag pushes and branch deletions do not deploy. For a manual deployment, publish the workflow on the default branch (`master`), then select **Actions → Deploy GreenZeta 2026 → Run workflow** and enter the target branch in the `branch` input. Existing branches must receive the workflow before their pushes can trigger automatic deployment. See [GitHub's workflow syntax reference](https://docs.github.com/en/actions/reference/workflows-and-actions/workflow-syntax) for trigger details.

Deployments share a concurrency group, verify SSH host keys, and update with fast-forward merges. Tracked server edits or target-branch commits absent from origin stop deployment; Git also refuses to overwrite conflicting untracked files. The deployed commit is the requested branch tip when the job fetches it. This updates files in place; no build, database migration, or service restart is configured.

## Custom Meta in the REST API

The theme registers the following single-value fields on `init` in `functions.php`. They appear under `meta` in `/wp-json/wp/v2/` responses and accept updates through the same property. Each registration retains its existing sanitizer and explicitly authorizes users with `edit_posts`, including Editors. WordPress also checks permission to edit the specific item. These fields are readable in public REST responses for public items, so keep their values suitable for public display.

| Meta key | Post types | REST type | Meaning / value format |
| --- | --- | --- | --- |
| `banner` | `post`, `update`, `portfolio`, `project` | integer | Banner image attachment ID; `0` uses the featured-image fallback. |
| `project_id` | `post`, `update` | integer | Linked Project's WordPress post ID, e.g. `1234`; a single ID, not a slug, URL, object, or list. Required when authoring Updates; optional for Posts (`0` means no link). |
| `client` | `portfolio`, `project` | string | Client name. |
| `screen_shots` | `portfolio`, `project` | array of integers | Ordered image attachment IDs, e.g. `[123, 456]`; one array stored in a single meta entry. |
| `case_video` | `portfolio`, `project` | string | Case-study video URL. |
| `case_poster` | `portfolio`, `project` | string | Poster image URL for the case-study video. |
| `live_site` | `portfolio`, `project` | string | Live site URL. |
| `production_link` | `project` | string | Project website URL. |
| `repo_link` | `project` | string | Source repository URL. |
| `featured_project` | `project` | boolean | Whether the project is featured on the front page. |
| `tag_line` | `project` | string | Project tagline, also used as its card title. |

REST clients should supply a valid `project_id` for Updates. The existing admin UI permits an unlinked Update; these registrations preserve that behavior and do not add a new validation rule or migrate data. All keys and storage formats are unchanged. Screenshot writes use the existing `wp_parse_id_list` sanitizer. The front end and admin also tolerate legacy comma-separated screenshot strings; WordPress's array REST schema can return `null` for such non-array legacy values until they are explicitly saved as an array. The boolean feature flag keeps its existing boolean sanitizer and is returned as a JSON boolean.

No theme-owned protected (underscore-prefixed) meta keys were found on these four post types. The `greenzeta_hero_*` fields belong to `page` and remain outside this scope. `_wp_attachment_image_alt` belongs to attachments and is managed by WordPress's media API. Featured images, tags, and categories use the standard REST properties rather than custom meta. `functions-production-reference.php` is an inactive reference and adds no custom post meta keys.

After deploying `functions.php`, authenticate as the Editor and GET `/wp-json/wp/v2/update/4402?context=edit`, then GET one item from each of `/posts/<id>`, `/portfolio/<id>`, and `/project/<id>` with `context=edit`. Confirm the applicable keys above are present under `meta`. On a draft, POST a body such as `{"meta":{"project_id":1234}}` (using a real Project ID) to `/wp-json/wp/v2/update/<draft-id>`, then GET it again to confirm persistence. Omitted meta fields remain unchanged. Use a draft's original values to restore it after verification.

Verification on October 15, 2026: PHP lint and `git diff --check` passed. An isolated copy of the saved local database, with WordPress 7.1.2, the current theme, and plugins disabled, passed 166 checks using `rest_do_request()` as a temporary Editor. GETs with `context=edit` returned the expected meta for Post 111, Update 227, Portfolio 211, and Project 221. Draft POST/GET round trips passed for every applicable field on all four types, including partial updates, boolean toggling, text/URL sanitization, invalid screenshot rejection, and anonymous write rejection. This tests WordPress's REST handlers and capabilities directly; live HTTP authentication as Webmaster remains unverified. Update 4402 was absent from the saved snapshot and returned 404 there. Deploy the theme and run the authenticated live checks above to finish production verification.
