document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const heroSection = document.querySelector('.hero');
    if (!heroSection || !header) return;
    header.classList.add('header-transparent');
    function handleScroll() {
        const scrollPosition = window.scrollY;
        if (scrollPosition > 1) {
            header.classList.remove('header-transparent');
            header.classList.add('header-scrolled');
        } else {
            header.classList.add('header-transparent');
            header.classList.remove('header-scrolled');
        }
    }
    let ticking = false;
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    }
    window.addEventListener('scroll', requestTick);
    handleScroll();
    window.addEventListener('resize', handleScroll);
});