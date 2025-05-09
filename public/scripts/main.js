/*hamburger_menu*/
document.getElementById('hamburger_menu').addEventListener('click',  function() {
    document.querySelector('aside').classList.toggle('open');
});

/*link to the add_bike view*/
document.getElementById('add-bike').addEventListener('click', () => {
    window.location.href = '/add_bike';
});
