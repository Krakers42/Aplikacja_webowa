fetch('/api/photos')
    .then(res => res.json())
    .then(photos => {
        photos.forEach(p => {
            const img = document.createElement('img');
            img.src = `data:${p.image_type};base64,${p.image}`;
            img.dataset.id = p.id;
            img.addEventListener('click', () => img.classList.toggle('selected'));
            gallery.appendChild(img);
        });
    });

fetch('/api/photos', {
    method: 'POST',
    body: fd,
    credentials: 'include'
});

fetch('/api/photos', {
    method: 'DELETE',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `id_photo=${sel.dataset.id}`,
    credentials: 'include'
});
