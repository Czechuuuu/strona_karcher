document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.getElementById('hamburger-menu');
  const nav = document.querySelector('header nav');
  const label = document.getElementById('hamburger-label');

  function updateLabel() {
    if (hamburger.classList.contains('active')) {
      label.innerHTML = '<span class="hamburger-label-line1">Zwiń</span><br><span class="hamburger-label-line2">Menu</span>';
    } else {
      label.innerHTML = '<span class="hamburger-label-line1">Rozwiń</span><br><span class="hamburger-label-line2">Menu</span>';
    }
  }
  function toggleMenu() {
    const expanded = hamburger.getAttribute('aria-expanded') === 'true';
    hamburger.setAttribute('aria-expanded', !expanded);
    hamburger.classList.toggle('active');
    if (nav.classList.contains('active')) {
      nav.classList.remove('active');
    } else {
      nav.classList.add('active');
    }
    updateLabel();
  }
  if (hamburger && nav && label) {
    hamburger.addEventListener('click', toggleMenu);
    label.addEventListener('click', toggleMenu);
    document.addEventListener('click', function(event) {
      if (nav.classList.contains('active') && 
          !nav.contains(event.target) && 
          !hamburger.contains(event.target) && 
          !label.contains(event.target)) {
        toggleMenu();
      }
    });
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape' && nav.classList.contains('active')) {
        toggleMenu();
      }
    });
    updateLabel();
  }
});
