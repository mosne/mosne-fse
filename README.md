# Mosne FSE

WordPress **full site editing** theme for [mosne.it](https://mosne.it), built with `theme.json`, HTML templates/parts, PHP patterns, and ACF blocks.

WordPress.org-style metadata lives in [`readme.txt`](readme.txt). This file is for developers.

## Requirements

- WordPress 7.0+
- PHP 7.4+ (theme header / tooling; prefer current supported PHP)
- [Node.js LTS](https://nodejs.org/) and npm (to compile assets)
- [Advanced Custom Fields](https://www.advancedcustomfields.com/) (blocks are `acf/*`)

## Directory structure

```
mosne-fse/
├── src/                    # Theme asset sources
│   ├── index.js            # Imports global styles
│   ├── style.scss          # Global SCSS entry
│   └── scripts.js          # Global frontend JS (vanilla)
├── dist/                   # Compiled, optimized assets (committed)
│   ├── style-index.css     # Global CSS (@wordpress/scripts naming)
│   ├── scripts.js
│   └── blocks/<slug>/      # Per-block CSS / view JS
├── assets/
│   ├── scss/               # Shared SCSS partials (variables, mixins, core blocks)
│   └── fonts/              # Theme fonts referenced from theme.json
├── blocks/                 # ACF blocks (one folder per block)
│   └── <slug>/
│       ├── block.json      # Metadata + file: asset paths
│       ├── *.php           # ACF render template
│       ├── index.js        # Imports block style.scss for the build
│       ├── style.scss      # Block styles
│       └── view.js         # Frontend JS (when needed)
├── templates/              # FSE templates
├── parts/                  # Template parts
├── patterns/               # Block patterns
├── inc/                    # PHP includes (enqueue, block registration, helpers)
├── theme.json              # Global settings & styles
├── functions.php
├── package.json
└── webpack.config.js       # Extends @wordpress/scripts → output to dist/
```

## Compile assets

Install dependencies once:

```bash
npm install
```

Development (watch + rebuild on change):

```bash
npm start
```

Production build (minify / optimize into `dist/`):

```bash
npm run build
```

Other scripts:

| Command | Purpose |
|---------|---------|
| `npm run lint:js` | ESLint via `@wordpress/scripts` |
| `npm run lint:css` | Stylelint via `@wordpress/scripts` |
| `npm run packages-update` | Update `@wordpress/*` packages |

After changing SCSS or JS, run `npm run build` (or keep `npm start` running) before reviewing the site. Deploy the theme with `dist/` included so production does not need Node.

### CSS output names

`@wordpress/scripts` names extracted CSS as `{stylesheet}-{entry}.css`. This theme uses `index` entries that import `style.scss`, so compiled files are `style-index.css` (same convention as `create-block`).

## How assets are loaded

### Theme (global)

[`inc/assets.php`](inc/assets.php) enqueues:

- `dist/style-index.css`
- `dist/scripts.js` (dependencies/version from `dist/scripts.asset.php` when present)

Editor styles use the same CSS via `add_editor_style( 'dist/style-index.css' )`.

There is **no jQuery** dependency. Frontend scripts are vanilla JS.

### Blocks

[`inc/register-blocks.php`](inc/register-blocks.php) only discovers folders under `blocks/` and calls `register_block_type()`. Styles and scripts are **not** registered in PHP.

Each [`block.json`](blocks/selected-works/block.json) declares assets with WordPress `file:` paths, for example:

```json
{
  "style": "file:../../dist/blocks/selected-works/style-index.css",
  "viewScript": "file:../../dist/blocks/selected-works/view.js"
}
```

- `style` — editor + frontend CSS  
- `viewScript` — frontend-only JS (loaded when the block is present)

ACF render templates (`acf.renderTemplate`) stay next to `block.json` and are unchanged.

## Adding a new ACF block

1. Create `blocks/my-block/` with `block.json`, render PHP, `style.scss`, and `index.js` (`import './style.scss';`).
2. Add `view.js` only if the block needs frontend JS.
3. Point `style` / `viewScript` in `block.json` at the matching files under `dist/blocks/my-block/`.
4. Add webpack entries in [`webpack.config.js`](webpack.config.js).
5. Run `npm run build`.

Registration is automatic via the `blocks/*` glob—no PHP asset handles required.

## License

GPL-2.0-or-later. See [`readme.txt`](readme.txt) and [`CREDITS.md`](CREDITS.md).
