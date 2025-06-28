document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.getElementById('hamburger-menu');
  const nav = document.querySelector('header nav');
  const label = document.getElementById('hamburger-label');

  function updateLabel() {
    if (hamburger.classList.contains('active')) {
      label.textContent = 'Zwiń menu';
    } else {
      label.textContent = 'Rozwiń menu';
    }
  }

  if (hamburger && nav && label) {
    hamburger.addEventListener('click', function() {
      const expanded = hamburger.getAttribute('aria-expanded') === 'true';
      hamburger.setAttribute('aria-expanded', !expanded);
      hamburger.classList.toggle('active');
      nav.classList.toggle('active');
      updateLabel();
    });
    label.addEventListener('click', function() {
      hamburger.click();
    });
    updateLabel();
  }
});
