function animateEquipmentItems(elements) {
    if (!elements) return;
    if (elements instanceof Element) elements = [elements];
    if (NodeList.prototype.isPrototypeOf(elements) || Array.isArray(elements)) {
        elements.forEach(item => {
            item.classList.remove('pop-anim');
            item.classList.remove('equipment-item-anim-bg');
            void item.offsetWidth;
            item.classList.add('pop-anim');
            item.classList.add('equipment-item-anim-bg');
        });
    }
}

function animateCategoryTitle(categoryCurrent) {
    if (!categoryCurrent) return;
    categoryCurrent.classList.remove('pop-anim');
    void categoryCurrent.offsetWidth;
    categoryCurrent.classList.add('pop-anim');
}

window.animateEquipmentItems = animateEquipmentItems;
window.animateCategoryTitle = animateCategoryTitle;
