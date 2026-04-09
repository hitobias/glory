import './main.css';

document.addEventListener('DOMContentLoaded', () => {
  initMobileDrawer();
  initMobileAccordion();
  initHeaderScroll();
  initScrollAnimations();
  initCounterAnimations();
  initSmoothScroll();
});

/* ---------- Mobile Drawer ---------- */
function initMobileDrawer() {
  const toggleBtn = document.querySelector('[data-drawer-toggle]');
  const closeBtn = document.querySelector('[data-drawer-close]');
  const overlay = document.querySelector('[data-drawer-overlay]');
  const panel = document.querySelector('[data-drawer-panel]');

  if (!toggleBtn || !panel) return;

  const open = () => {
    panel.classList.add('active');
    overlay?.classList.add('active');
    toggleBtn.classList.add('is-active');
    document.body.style.overflow = 'hidden';
    toggleBtn.setAttribute('aria-expanded', 'true');
  };

  const shut = () => {
    panel.classList.remove('active');
    overlay?.classList.remove('active');
    toggleBtn.classList.remove('is-active');
    document.body.style.overflow = '';
    toggleBtn.setAttribute('aria-expanded', 'false');
  };

  toggleBtn.addEventListener('click', open);
  closeBtn?.addEventListener('click', shut);
  overlay?.addEventListener('click', shut);

  // Close drawer on link click (navigate away)
  panel.querySelectorAll('a[href]').forEach((link) => {
    link.addEventListener('click', () => {
      // Short delay so the page can navigate
      setTimeout(shut, 150);
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && panel.classList.contains('active')) shut();
  });
}

/* ---------- Mobile Accordion Sub-menus ---------- */
function initMobileAccordion() {
  const parentItems = document.querySelectorAll('.mobile-nav > li.menu-item-has-children');

  parentItems.forEach((li) => {
    const subMenu = li.querySelector('.sub-menu');
    if (!subMenu) return;

    // Create toggle button
    const toggle = document.createElement('button');
    toggle.className = 'mobile-submenu-toggle';
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', '展開子選單');
    toggle.innerHTML = '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';

    li.appendChild(toggle);

    // If current page is in this sub-menu, open it by default
    const isAncestor = li.classList.contains('current-menu-ancestor') || li.classList.contains('current-menu-item');
    if (isAncestor) {
      openSubmenu(subMenu, toggle);
    }

    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();

      if (subMenu.classList.contains('is-open')) {
        closeSubmenu(subMenu, toggle);
      } else {
        openSubmenu(subMenu, toggle);
      }
    });
  });
}

function openSubmenu(subMenu, toggle) {
  subMenu.classList.add('is-open');
  subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
  toggle.classList.add('is-open');
  toggle.setAttribute('aria-expanded', 'true');
}

function closeSubmenu(subMenu, toggle) {
  subMenu.classList.remove('is-open');
  subMenu.style.maxHeight = '0';
  toggle.classList.remove('is-open');
  toggle.setAttribute('aria-expanded', 'false');
}

/* ---------- Header Scroll Effect ---------- */
function initHeaderScroll() {
  const headerWrap = document.querySelector('.header-wrap');
  if (!headerWrap) return;

  let ticking = false;

  const onScroll = () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        headerWrap.classList.toggle('header-scrolled', window.scrollY > 50);
        ticking = false;
      });
      ticking = true;
    }
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
}

/* ---------- Scroll Animations (Intersection Observer) ---------- */
function initScrollAnimations() {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (prefersReducedMotion) {
    document.querySelectorAll('[data-animate], [data-stagger]').forEach((el) => {
      el.classList.add('animate-in');
    });
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
  );

  document.querySelectorAll('[data-animate], [data-stagger]').forEach((el) => {
    observer.observe(el);
  });
}

/* ---------- Counter Animations ---------- */
function initCounterAnimations() {
  const counters = document.querySelectorAll('[data-counter]');
  if (!counters.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.3 }
  );

  counters.forEach((el) => observer.observe(el));
}

function animateCounter(el) {
  const target = parseInt(el.dataset.counter, 10);
  const suffix = el.dataset.counterSuffix || '';
  const duration = 1600;
  const start = performance.now();

  const step = (now) => {
    const elapsed = now - start;
    const progress = Math.min(elapsed / duration, 1);
    // Ease out cubic
    const eased = 1 - Math.pow(1 - progress, 3);
    const current = Math.round(eased * target);

    el.textContent = current.toLocaleString() + suffix;

    if (progress < 1) {
      requestAnimationFrame(step);
    }
  };

  requestAnimationFrame(step);
}

/* ---------- Smooth Scroll ---------- */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const id = anchor.getAttribute('href');
      if (id === '#') return;

      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        const headerH = document.querySelector('.header-wrap')?.offsetHeight || 0;
        const y = target.getBoundingClientRect().top + window.scrollY - headerH - 16;
        window.scrollTo({ top: y, behavior: 'smooth' });
      }
    });
  });
}
