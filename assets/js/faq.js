document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.faq-question').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var item = btn.closest('.faq-item');
      item.classList.toggle('open');
      document.querySelectorAll('.faq-item').forEach(function(other) {
        if (other !== item) other.classList.remove('open');
      });
    });
  });
});
