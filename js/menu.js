document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const menuOverlay = document.getElementById('menuOverlay');

    menuToggle.addEventListener('click', function() {
        menuOverlay.style.display = menuOverlay.style.display === 'flex' ? 'none' : 'flex';
    });

    menuOverlay.addEventListener('click', function(event) {
        if (event.target === menuOverlay) {
            menuOverlay.style.display = 'none';
        }
    });
});
