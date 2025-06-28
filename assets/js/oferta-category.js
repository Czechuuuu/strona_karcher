document.addEventListener('DOMContentLoaded', function() {
  const tiles = document.querySelectorAll('.category-tile');
  const groups = document.querySelectorAll('.equipment-group');
  const label = document.getElementById('current-category-label');
  const categoryCurrent = document.querySelector('.category-current');

  if(groups.length > 0) {
    groups.forEach(group => {
      if(group.style.display === '' || group.style.display === 'block') {
        window.animateEquipmentItems && window.animateEquipmentItems(group.querySelectorAll('.equipment-item'));
      }
    });
    window.animateCategoryTitle && window.animateCategoryTitle(categoryCurrent);
  }

  tiles.forEach(tile => {
    tile.addEventListener('click', function() {
      const val = this.getAttribute('data-category');
      tiles.forEach(k => k.classList.remove('active'));
      this.classList.add('active');
      groups.forEach(group => {
        if(group.getAttribute('data-category') === val) {
          group.style.display = '';
          window.animateEquipmentItems && window.animateEquipmentItems(group.querySelectorAll('.equipment-item'));
        } else {
          group.style.display = 'none';
        }
      });
      if(label) {
        label.textContent = this.querySelector('.name').textContent;
        window.animateCategoryTitle && window.animateCategoryTitle(categoryCurrent);
      }
    });
  });

  const homeEquipment = document.querySelectorAll('.equipment-home .equipment-item');
  if(homeEquipment.length > 0 && window.animateEquipmentItems) {
    window.animateEquipmentItems(homeEquipment);
  }
});
