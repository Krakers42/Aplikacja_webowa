document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.getElementById('hamburger_menu');
    const addBikeLink = document.getElementById('add-bike');

    if (hamburger) {
        hamburger.addEventListener('click', function() {
            const aside = document.querySelector('aside');
            if (aside) aside.classList.toggle('open');
        });
    }

    if (addBikeLink) {
        addBikeLink.addEventListener('click', () => {
            window.location.href = '/add_bike';
        });
    }
});
