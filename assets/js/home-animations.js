document.addEventListener('DOMContentLoaded', function() {
  const homeEquipment = document.querySelectorAll('.equipment-home .equipment-item');
  if(homeEquipment.length > 0 && window.animateEquipmentItems) {
    window.animateEquipmentItems(homeEquipment);
  }
});
