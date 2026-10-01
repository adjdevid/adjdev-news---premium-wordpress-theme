# ADJDEV News — Premium WordPress Theme & Ecosystem Foundation

**Theme Name:** ADJDEV News  
**Version:** 1.0.0  
**Requires PHP:** 8.1+ (Compatible up to PHP 8.3+)  
**Requires WordPress:** 6.2+  
**Text Domain:** `adjdev-news`  
**Author:** ADJDEV Team  
**License:** GNU General Public License v2 or later  

---

## 1. Concept & Architecture Overview

**ADJDEV News** is a premium, lightweight, and modular WordPress theme designed for high-traffic media portals, national/regional newspapers, technology publications, magazines, and lifestyle blogs.

Unlike monolithic commercial themes, ADJDEV News is built upon a **decoupled, modular architecture** that prioritizes:
1. **Core Web Vitals & Extreme Performance:**
   - 0 jQuery dependency on the frontend.
   - 100% Native Vanilla JavaScript with event delegation and passive scroll listeners.
   - Defer and non-blocking asset loading.
   - Core emoji scripts conditionally stripped.
   - Native lazy loading & async image decoding.
2. **Dynamic Template Library (`/templates-library/`):**
   - Automatically detects template packages in `/templates-library/`.
   - Never hardcodes template names in PHP files.
   - Safe configuration importing without deleting posts, pages, or media.
   - Strict validation preventing arbitrary code execution.
3. **Foundation for ADJDEV Builder:**
   - Comprehensive Hook & Filter API (`do_action('adjdev_news_*')` & `apply_filters('adjdev_news_*')`).
   - Section registration API (`ADJDEV_News_Builder_API::register_section`).
   - Dynamic Data Tags API (`ADJDEV_News_Builder_API::register_dynamic_tag`).
   - Design tokens exposed as standard CSS variables.
   - Blank Canvas template (`template-canvas.php`) for full visual builder control.

---

## 2. Directory Structure

```text
adjdev-news/
├── style.css                      # Master theme header & CSS design tokens
├── functions.php                  # Theme bootstrap & modular autoloader
├── index.php                      # Fallback posts loop
├── header.php                     # HTML head & dynamic header switcher
├── footer.php                     # Footer columns & modals
├── single.php                     # Rich single article template
├── page.php                       # Default page template
├── archive.php                    # Category/tag/author archives
├── search.php                     # Search query results
├── 404.php                        # 404 error page with search & recent posts
├── README.md                      # Comprehensive developer documentation
├── CHANGELOG.md                   # Version history
│
├── inc/                           # Core Theme Engine
│   ├── core-constants.php         # Version, directory, and URL definitions
│   ├── theme-setup.php            # Menus, image sizes, theme supports
│   ├── theme-assets.php           # Enqueue CSS/JS conditionally & defer
│   ├── theme-options-defaults.php # 36+ Settings default configurations
│   ├── theme-options-framework.php# Options getter, sanitizer & dynamic CSS
│   ├── template-tags.php          # Byline, date, badges, reading time, share
│   ├── template-functions.php     # Body classes, excerpt filters, ad hooks
│   ├── template-library-scanner.php # Dynamic scanner for /templates-library/
│   ├── builder-api.php            # API for upcoming ADJDEV Builder plugin
│   ├── ads-manager.php            # Multi-slot ad manager
│   ├── seo-schema.php             # JSON-LD Schema.org NewsArticle
│   ├── breadcrumbs.php            # Breadcrumbs with microdata
│   ├── reading-progress.php       # Article progress bar
│   ├── post-views.php             # Post view counter (bot-safe)
│   └── ajax-handlers.php          # Admin AJAX handlers with nonce checks
│
├── admin/                         # WordPress Admin Panel
│   ├── admin-init.php             # Menu pages & admin asset loading
│   ├── class-theme-options.php    # 36-Tab Theme Options UI
│   ├── class-template-library.php # Template Library management UI
│   ├── class-system-info.php      # Diagnostic server environment check
│   ├── class-import-export.php    # JSON backup and restore tool
│   ├── css/admin-options.css      # Modern dark/light admin interface
│   └── js/admin-options.js        # Search filter, color picker & AJAX save
│
├── assets/                        # Frontend Production Assets
│   ├── css/
│   │   ├── main.css               # Grid, loops, sidebar, widgets, pagination
│   │   ├── header.css             # Header layouts & navigation
│   │   ├── footer.css             # Footer widgets & bottom copyright
│   │   ├── single-post.css        # Single article typography, TOC & share
│   │   └── dark-mode.css          # Dark theme colors and form controls
│   ├── js/
│   │   ├── main.js                # Vanilla JS: drawer, modal, dark mode, back-to-top
│   │   └── single-post.js         # TOC toggle & smooth scroll, copy link
│   └── images/
│       └── default-placeholder.svg# Fallback news placeholder graphic
│
├── template-parts/                # Modular UI Partials
│   ├── header/                    # default, classic, center-logo, magazine, minimal, topbar, breaking-news, search-modal, mobile-drawer
│   ├── footer/                    # footer-default, footer-bottom
│   ├── hero/                      # hero-grid (1 lead + 4 sub-featured)
│   ├── post/                      # content-card, content-list, content-overlay, content-none
│   └── single/                    # entry-header, media, share, author, navigation, related, toc, newsletter, reading-progress
│
├── templates/                     # Custom Page Templates
│   ├── template-canvas.php        # Blank Canvas for visual builders
│   ├── template-fullwidth.php     # Fullwidth page
│   └── template-homepage.php      # Modular news homepage
│
├── blocks/                        # Gutenberg Integration
│   └── patterns.php               # Native news block patterns
│
├── widgets/                       # Classic & Block Widgets
│   ├── class-widget-recent-posts.php
│   ├── class-widget-trending.php
│   ├── class-widget-author.php
│   └── class-widget-ad.php
│
├── languages/                     # Translation
│   └── adjdev-news.pot            # Gettext POT translation template
│
└── templates-library/             # Extensible Template Packages
    ├── news-modern/               # Modern digital news portal
    ├── tempo-style/               # Investigative journalism portal
    ├── kompas-style/              # Broadsheet newspaper layout
    ├── detik-style/               # High-velocity breaking news
    ├── magazine-modern/           # Visual magazine & culture
    ├── tech-news/                 # Technology & gadgets publication
    ├── portal-nasional/           # National policy & state affairs
    ├── portal-regional/           # Regional & community portal
    ├── minimal-news/              # Typography-first minimalist
    ├── lifestyle/                 # Culinary, travel & trends
    ├── dark-news/                 # OLED night reader edition
    └── editorial/                 # Longform literary broadsheet
```

---

## 3. How to Create a New Template in Template Library

The Template Library does not require editing any PHP code. The scanner automatically detects any subfolder inside `/templates-library/` that contains a valid `template.json`.

### Step 1: Create a Folder
Create a folder inside `/templates-library/` with a slug name, e.g.:
`/templates-library/finance-portal/`

### Step 2: Create `template.json`
Inside your folder, create `template.json`:
```json
{
  "id": "finance-portal",
  "name": "Finance & Market Portal",
  "description": "Stock tickers, currency rates, business market grid, and high-density financial news.",
  "version": "1.0.0",
  "author": "Your Company / ADJDEV",
  "category": "Business",
  "preview": "preview.jpg",
  "screenshot": "screenshot.jpg",
  "supported_features": [
    "Market Tickers",
    "Candlestick Grid",
    "Earnings Calendar",
    "Dark Mode"
  ],
  "required_theme_version": "1.0.0"
}
```

### Step 3: Create `config.json` (Optional Layout Preset)
Add `config.json` to define initial Theme Options applied when activated:
```json
{
  "header_layout": "classic",
  "color_primary": "#059669",
  "color_secondary": "#064e3b",
  "color_accent": "#10b981",
  "homepage_hero_style": "grid",
  "blog_layout": "list",
  "single_sidebar_position": "right",
  "site_layout": "fullwidth",
  "container_width": 1260,
  "breaking_news_enable": true,
  "dark_mode_enable": true
}
```

### Step 4: Add Preview Graphic
Place a `preview.jpg` or `preview.svg` (600x380px) in the folder.

### Step 5: Activate
Open WordPress Admin -> **ADJDEV News -> Template Library**. Your template will be immediately visible with a 1-click **Activate** button!

---

## 4. ADJDEV Builder API & Extensibility

When the future **ADJDEV Builder** plugin is installed, it uses the following core APIs provided by this theme:

### Action Hooks
- `adjdev_news_loaded`: Fires when theme core is fully loaded.
- `adjdev_news_before_site_wrapper`: Top alerts, notice bars.
- `adjdev_news_after_header`: Injected hero builders or tickers.
- `adjdev_news_before_footer`: Injected fullwidth callouts or footers.
- `adjdev_news_builder_section_registered`: Fired when a builder section is registered.

### Section Registration API
```php
ADJDEV_News_Builder_API::register_section( 'custom_breaking_grid', array(
    'title'           => 'Custom Breaking Grid',
    'category'        => 'news',
    'render_callback' => function( $settings ) {
        // Render custom block
    },
) );
```

### Dynamic Tokens API
All theme design tokens are standard CSS variables:
```css
--adjdev-primary
--adjdev-primary-hover
--adjdev-secondary
--adjdev-accent
--adjdev-text
--adjdev-background
--adjdev-container
--adjdev-radius
```

---

## 5. Security & WordPress Coding Standards
- Capability checks: `current_user_can('edit_theme_options')` enforced on all admin and AJAX actions.
- CSRF protection: `check_ajax_referer('adjdev_news_admin_nonce')`.
- Sanitization: `sanitize_text_field`, `sanitize_key`, `esc_url_raw`, `sanitize_hex_color`, and `wp_strip_all_tags`.
- Escaping: `esc_html`, `esc_attr`, `esc_url`, and `wp_kses_post`.
- Safe file handling: Directory traversal prevented via `sanitize_file_name` and strict folder scanning.
- No arbitrary PHP inclusion from template packages.
