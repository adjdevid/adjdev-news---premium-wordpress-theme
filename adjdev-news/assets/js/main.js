/**
 * ADJDEV News Frontend Vanilla JavaScript
 * Zero jQuery dependency for 100/100 Core Web Vitals
 */
(function () {
  'use strict';

  // 1. Dark Mode System
  const themeToggleButtons = document.querySelectorAll('.adjdev-theme-toggle');
  const htmlRoot = document.documentElement;

  function initTheme() {
    const savedTheme = localStorage.getItem('adjdev_theme');
    if (savedTheme) {
      setTheme(savedTheme);
    } else {
      const defaultMode = (window.adjdevNewsData && window.adjdevNewsData.darkModeDefault) || 'system';
      if (defaultMode === 'system') {
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        setTheme(prefersDark ? 'dark' : 'light');
      } else {
        setTheme(defaultMode);
      }
    }
  }

  function setTheme(theme) {
    htmlRoot.setAttribute('data-theme', theme);
    if (theme === 'dark') {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
    localStorage.setItem('adjdev_theme', theme);
  }

  themeToggleButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const currentTheme = htmlRoot.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      setTheme(currentTheme);
    });
  });

  initTheme();

  // 2. Mobile Drawer Navigation
  const mobileToggle = document.querySelector('.mobile-menu-trigger');
  const mobileDrawer = document.getElementById('adjdev-mobile-drawer');
  const drawerClose = document.querySelector('.mobile-drawer-close');
  const drawerOverlay = document.querySelector('.mobile-drawer-overlay');

  function openMobileDrawer() {
    if (mobileDrawer) {
      mobileDrawer.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeMobileDrawer() {
    if (mobileDrawer) {
      mobileDrawer.classList.remove('is-open');
      document.body.style.overflow = '';
    }
  }

  if (mobileToggle) {
    mobileToggle.addEventListener('click', openMobileDrawer);
  }
  if (drawerClose) {
    drawerClose.addEventListener('click', closeMobileDrawer);
  }
  if (drawerOverlay) {
    drawerOverlay.addEventListener('click', closeMobileDrawer);
  }

  // 3. Search Modal
  const searchTriggers = document.querySelectorAll('.adjdev-search-trigger');
  const searchModal = document.getElementById('adjdev-search-modal');
  const searchModalClose = document.querySelector('.search-modal-close');

  function openSearchModal() {
    if (searchModal) {
      searchModal.classList.add('is-active');
      const input = searchModal.querySelector('input[type="search"]');
      if (input) {
        setTimeout(() => input.focus(), 150);
      }
    }
  }

  function closeSearchModal() {
    if (searchModal) {
      searchModal.classList.remove('is-active');
    }
  }

  searchTriggers.forEach(btn => btn.addEventListener('click', openSearchModal));
  if (searchModalClose) {
    searchModalClose.addEventListener('click', closeSearchModal);
  }

  // Close modals on Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeMobileDrawer();
      closeSearchModal();
    }
  });

  // 4. Sticky Header & Back to Top
  const siteHeader = document.querySelector('.site-header');
  const backToTop = document.getElementById('adjdev-back-to-top');

  window.addEventListener('scroll', function () {
    const scrollY = window.scrollY;

    // Sticky Header
    if (siteHeader && window.adjdevNewsData && window.adjdevNewsData.stickyHeader) {
      if (scrollY > 160) {
        siteHeader.classList.add('is-sticky');
      } else {
        siteHeader.classList.remove('is-sticky');
      }
    }

    // Back to top visibility
    if (backToTop) {
      if (scrollY > 400) {
        backToTop.classList.add('is-visible');
      } else {
        backToTop.classList.remove('is-visible');
      }
    }
  }, { passive: true });

  if (backToTop) {
    backToTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

})();
