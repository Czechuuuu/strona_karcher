document.addEventListener('DOMContentLoaded', function() {
  const tiles = document.querySelectorAll('.category-tile');
  const groups = document.querySelectorAll('.equipment-group');
  const label = document.getElementById('current-category-label');
  const categoryCurrent = document.querySelector('.category-current');

  function animateCategoryTitle() {
    if (!categoryCurrent) return;
    categoryCurrent.classList.remove('pop-anim');
    void categoryCurrent.offsetWidth;
    categoryCurrent.classList.add('pop-anim');
  }

  tiles.forEach(tile => {
    tile.addEventListener('click', function() {
      const val = this.getAttribute('data-category');
      tiles.forEach(k => k.classList.remove('active'));
      this.classList.add('active');
      groups.forEach(group => {
        if(group.getAttribute('data-category') === val) {
          group.style.display = '';
        } else {
          group.style.display = 'none';
        }
      });
      if(label) {
        label.textContent = this.querySelector('.name').textContent;
        animateCategoryTitle();
      }
    });
  });
});
