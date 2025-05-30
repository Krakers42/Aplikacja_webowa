
document.querySelectorAll('.delete-bike').forEach(button => {
    button.addEventListener('click', () => {
        const bikeId = button.dataset.id;
        if (confirm('Are you sure you want to delete this bike?')) {
            window.location.href = `/bikeController/delete_bike/${bikeId}`;
        }
    });
});

document.querySelectorAll('.edit-bike').forEach(button => {
    button.addEventListener('click', () => {
        const bikeId = button.dataset.id;
        window.location.href = `/bikeController/edit_bike/${bikeId}`;
    });
});
