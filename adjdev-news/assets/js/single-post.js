/**
 * ADJDEV News Single Article JavaScript
 * High performance, zero jQuery
 */
(function () {
  'use strict';

  // 1. Reading Progress Bar
  const progressBar = document.querySelector('.adjdev-reading-progress-fill');
  const article = document.querySelector('.adjdev-single-article');

  if (progressBar && article) {
    window.addEventListener('scroll', function () {
      const articleRect = article.getBoundingClientRect();
      const articleTop = articleRect.top + window.scrollY;
      const articleHeight = articleRect.height;
      const scrollY = window.scrollY;
      const windowHeight = window.innerHeight;

      if (scrollY < articleTop) {
        progressBar.style.width = '0%';
      } else if (scrollY > (articleTop + articleHeight - windowHeight)) {
        progressBar.style.width = '100%';
      } else {
        const progress = ((scrollY - articleTop) / (articleHeight - windowHeight)) * 100;
        progressBar.style.width = Math.min(100, Math.max(0, progress)) + '%';
      }
    }, { passive: true });
  }

  // 2. Table of Contents (TOC) Toggle & Smooth Scroll
  const tocToggle = document.querySelector('.toc-toggle-btn');
  const tocList = document.querySelector('.toc-list');

  if (tocToggle && tocList) {
    tocToggle.addEventListener('click', function () {
      const isHidden = tocList.style.display === 'none';
      tocList.style.display = isHidden ? 'block' : 'none';
      tocToggle.textContent = isHidden ? '[Hide]' : '[Show]';
    });
  }

  // Smooth scroll for TOC links
  const tocLinks = document.querySelectorAll('.toc-list a[href^="#"]');
  tocLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      const targetElem = document.querySelector(targetId);
      if (targetElem) {
        targetElem.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

  // 3. Copy Link Share Button
  const copyButtons = document.querySelectorAll('.share-copy-link');
  copyButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const shareBar = this.closest('.adjdev-share-bar');
      const url = shareBar ? shareBar.getAttribute('data-url') : window.location.href;

      if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
          showCopyTooltip(btn);
        });
      } else {
        // Fallback
        const temp = document.createElement('input');
        temp.value = url;
        document.body.appendChild(temp);
        temp.select();
        document.execCommand('copy');
        document.body.removeChild(temp);
        showCopyTooltip(btn);
      }
    });
  });

  function showCopyTooltip(btn) {
    const originalSvg = btn.innerHTML;
    btn.innerHTML = '<span style="font-size:11px;font-weight:700;">OK!</span>';
    setTimeout(() => {
      btn.innerHTML = originalSvg;
    }, 1800);
  }

})();
