# Changelog — ADJDEV News WordPress Theme

All notable changes to the ADJDEV News theme will be documented in this file.

## [1.0.0] - Initial Production Release
### Added
- **Core Architecture:**
  - Modern, decoupled, modular architecture adhering to WordPress Coding Standards.
  - PHP 8.1+ support with safe types and strict sanitization.
  - Native Theme Support: `title-tag`, `post-thumbnails`, `automatic-feed-links`, `html5`, `align-wide`, `responsive-embeds`, `editor-styles`.
  - Registered 4 navigation menu locations (`primary`, `topbar`, `mobile`, `footer`).
  - Registered 8 widget areas (Main Sidebar, Single Sidebar, Page Sidebar, Archive Sidebar, 4 Footer Columns).
- **Theme Options Framework:**
  - Fast, lightweight settings storage under `adjdev_news_theme_options`.
  - Comprehensive 36 setting tabs with real-time controls.
  - AJAX non-blocking save with nonces and capability verification.
  - One-click reset to defaults and section resetting.
  - Import and Export JSON configurations with validation.
- **Dynamic Template Library:**
  - Dynamic filesystem scanning in `/templates-library/`.
  - Zero-hardcoding template detection.
  - Metadata parsing from `template.json` with fallback and cache via Transients.
  - Safe 1-click template preset activation without content destruction.
  - 12 original included templates:
    1. News Modern
    2. Investigative Tempo Style
    3. National Broadsheet (Kompas Style)
    4. High Velocity (Detik Style)
    5. Magazine Modern
    6. Tech & Cyber News
    7. Portal Nasional RI
    8. Portal Regional & Daerah
    9. Minimal News
    10. Lifestyle & Culture
    11. Dark News Edition
    12. Editorial & Essays
- **ADJDEV Builder Foundation API:**
  - Hook and Filter architecture (`adjdev_news_*`).
  - Section registration API (`ADJDEV_News_Builder_API::register_section`).
  - Dynamic Data API (`ADJDEV_News_Builder_API::register_dynamic_tag`).
  - CSS Variables and Design Tokens registry.
  - Blank Canvas template (`template-canvas.php`).
- **Performance & Core Web Vitals:**
  - Zero jQuery frontend dependency.
  - 100% Vanilla JavaScript.
  - Deferred script loading.
  - Optional core emoji script removal.
- **Single Article Features:**
  - Automated Table of Contents (TOC) with heading auto-detection.
  - Real-time Reading Progress bar.
  - Word-count based reading time calculator.
  - Cookie and bot-safe post view counter.
  - Top & Bottom multi-platform share buttons (WhatsApp, X, Facebook, Telegram, LinkedIn, Copy Link).
  - In-content, Header, Footer, and Sidebar advertisement management.
  - Author bio box and previous/next article cards.
- **Dark Mode:**
  - Native CSS Variables dark mode.
  - OS system preference auto-detection.
  - Manual toggle button with `localStorage` persistence.
