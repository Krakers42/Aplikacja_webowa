function editTrip(trip) {
    document.getElementById('editId').value = trip.id_trip;
    document.getElementById('editDate').value = trip.date;
    document.getElementById('editTime').value = trip.time;
    document.getElementById('editDistance').value = trip.distance;
    document.getElementById('editElevation').value = trip.elevation;
    document.getElementById('editDescription').value = trip.description;
    document.getElementById('editForm').style.display = 'block';
    window.scrollTo(0, document.body.scrollHeight);
}
