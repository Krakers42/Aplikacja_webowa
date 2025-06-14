function editPart(id_gear_part, purchase_date, name, value, comment) {
    document.getElementById('editId').value = id_gear_part;
    document.getElementById('editPurchaseDate').value = purchase_date;
    document.getElementById('editName').value = name;
    document.getElementById('editValue').value = value;
    document.getElementById('editComment').value = comment;
    document.getElementById('editForm').style.display = 'block';
    window.scrollTo(0, document.body.scrollHeight);
}