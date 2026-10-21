/**
* Template Name: Axis
* Template URL: https://bootstrapmade.com/axis-bootstrap-corporate-template/
* Updated: Sep 13 2025 with Bootstrap v5.3.8
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    const removePreloader = () => {
      preloader.style.opacity = '0';
      preloader.style.visibility = 'hidden';
      preloader.style.pointerEvents = 'none';
      setTimeout(() => preloader.remove(), 250);
    };

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', removePreloader, { once: true });
    } else {
      removePreloader();
    }

    window.addEventListener('load', () => preloader.remove(), { once: true });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', aosInit, { once: true });
  } else {
    aosInit();
  }

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Hash targets on the home page use content-visibility placeholders until scrolled.
   * Reveal sections through the target so scroll position matches real layout height.
   */
  function revealHomeSectionsUpTo(targetSection) {
    if (!document.body.classList.contains('home-page') || !targetSection) {
      return;
    }

    document.querySelectorAll('body.home-page main.main > section').forEach((section) => {
      section.style.contentVisibility = 'visible';
    });
  }

  function scrollToHashSection(hash, behavior = 'auto') {
    const safeHash = (hash || '').split('?')[0];
    if (!safeHash || safeHash === '#') {
      return false;
    }

    const section = document.querySelector(safeHash);
    if (!section) {
      return false;
    }

    revealHomeSectionsUpTo(section);

    const scrollMarginTop = parseInt(getComputedStyle(section).scrollMarginTop, 10) || 0;
    const top = section.getBoundingClientRect().top + window.scrollY - scrollMarginTop;
    window.scrollTo({ top: Math.max(0, top), behavior });

    return true;
  }

  function ensureHashScroll(hash) {
    const run = (behavior) => scrollToHashSection(hash, behavior);

    run('auto');
    requestAnimationFrame(() => {
      requestAnimationFrame(() => run('auto'));
    });
    [100, 350, 700].forEach((delay) => {
      setTimeout(() => run('auto'), delay);
    });
  }

  document.querySelectorAll('a[href*="#"]').forEach((link) => {
    link.addEventListener('click', function(e) {
      let url;
      try {
        url = new URL(this.href, window.location.href);
      } catch (error) {
        return;
      }

      const hash = (url.hash || '').split('?')[0];
      if (!hash || hash === '#') {
        return;
      }

      if (url.pathname !== window.location.pathname) {
        return;
      }

      e.preventDefault();
      window.history.pushState(null, '', `${url.pathname}${url.search}${hash}`);
      scrollToHashSection(hash, 'smooth');
      [100, 350, 700].forEach((delay) => {
        setTimeout(() => scrollToHashSection(hash, 'auto'), delay);
      });
    });
  });

  if (window.location.hash) {
    const initialHash = window.location.hash.split('?')[0];
    ensureHashScroll(initialHash);
    window.addEventListener('load', () => ensureHashScroll(initialHash), { once: true });
  }

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll('.navmenu a');

  function navmenuScrollspy() {
    navmenulinks.forEach(navmenulink => {
      if (!navmenulink.hash) return;
      const safeHash = navmenulink.hash.split('?')[0];
      let section = document.querySelector(safeHash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
        navmenulink.classList.add('active');
      } else {
        navmenulink.classList.remove('active');
      }
    })
  }
  window.addEventListener('load', navmenuScrollspy);
  document.addEventListener('scroll', navmenuScrollspy);

})();
