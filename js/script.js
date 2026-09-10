// ============================================================
// Serraria Bom Corte — interações da página
// ============================================================

document.addEventListener('DOMContentLoaded', () => {
  initHeaderScroll();
  initMobileMenu();
  initActiveNav();
  initContactForm();
  initFooterYear();
});

/* ---------- sombra no header ao rolar ---------- */
function initHeaderScroll() {
  const header = document.getElementById('site-header');
  if (!header) return;

  const toggle = () => {
    header.classList.toggle('is-scrolled', window.scrollY > 8);
  };

  toggle();
  window.addEventListener('scroll', toggle, { passive: true });
}

/* ---------- menu mobile ---------- */
function initMobileMenu() {
  const toggleBtn = document.getElementById('menu-toggle');
  const nav = document.getElementById('main-nav');
  if (!toggleBtn || !nav) return;

  const closeMenu = () => {
    nav.classList.remove('is-open');
    toggleBtn.setAttribute('aria-expanded', 'false');
    toggleBtn.setAttribute('aria-label', 'Abrir menu');
  };

  const openMenu = () => {
    nav.classList.add('is-open');
    toggleBtn.setAttribute('aria-expanded', 'true');
    toggleBtn.setAttribute('aria-label', 'Fechar menu');
  };

  toggleBtn.addEventListener('click', () => {
    const isOpen = nav.classList.contains('is-open');
    isOpen ? closeMenu() : openMenu();
  });

  // fecha o menu ao clicar em um link
  nav.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeMenu);
  });

  // fecha o menu ao redimensionar para desktop
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 900) closeMenu();
  });
}

/* ---------- link ativo conforme a seção visível ---------- */
function initActiveNav() {
  const navLinks = Array.from(document.querySelectorAll('.main-nav a'));
  if (!navLinks.length) return;

  const sections = navLinks
    .filter((link) => link.getAttribute('href').startsWith('#'))
    .map((link) => document.querySelector(link.getAttribute('href')))
    .filter(Boolean);

  if (!('IntersectionObserver' in window) || !sections.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const id = `#${entry.target.id}`;
        navLinks.forEach((link) => {
          link.classList.toggle('is-active', link.getAttribute('href') === id);
        });
      });
    },
    { rootMargin: '-45% 0px -50% 0px', threshold: 0 }
  );

  sections.forEach((section) => observer.observe(section));
}

/* ---------- validação do formulário de contato ---------- */
function initContactForm() {
  const form = document.getElementById('contact-form');
  const status = document.getElementById('form-status');
  if (!form || !status) return;

  const rules = {
    nome: (value) => value.trim().length >= 2 || 'Informe seu nome completo.',
    email: (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim()) || 'Informe um e-mail válido.',
    mensagem: (value) => value.trim().length >= 10 || 'Conte com mais detalhes o que você precisa.',
  };

  const validateField = (field) => {
    const rule = rules[field.name];
    if (!rule) return true;

    const row = field.closest('.form-row');
    const errorEl = row ? row.querySelector('.form-error') : null;
    const result = rule(field.value);

    if (result === true) {
      row && row.classList.remove('has-error');
      if (errorEl) errorEl.textContent = '';
      return true;
    }

    row && row.classList.add('has-error');
    if (errorEl) errorEl.textContent = result;
    return false;
  };

  // valida ao sair do campo
  Object.keys(rules).forEach((name) => {
    const field = form.elements[name];
    if (field) field.addEventListener('blur', () => validateField(field));
  });

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    let isValid = true;
    Object.keys(rules).forEach((name) => {
      const field = form.elements[name];
      if (field && !validateField(field)) isValid = false;
    });

    if (!isValid) {
      status.style.color = '#a13d2e';
      status.textContent = 'Verifique os campos destacados antes de enviar.';
      return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    status.style.color = '#4d4234';
    status.textContent = 'Enviando...';

    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
    })
      .then((response) => response.json())
      .then((data) => {
        status.style.color = data.success ? '#384a2d' : '#a13d2e';
        status.textContent = data.message;
        if (data.success) form.reset();
      })
      .catch(() => {
        status.style.color = '#a13d2e';
        status.textContent = 'Não foi possível enviar agora. Tente novamente em instantes.';
      })
      .finally(() => {
        submitBtn.disabled = false;
      });
  });
}

/* ---------- ano atual no rodapé ---------- */
function initFooterYear() {
  const el = document.getElementById('ano-atual');
  if (el) el.textContent = new Date().getFullYear();
}
