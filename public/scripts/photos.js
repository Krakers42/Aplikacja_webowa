const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const gallery = document.getElementById('gallery');

dropArea.addEventListener('click', () => fileInput.click());

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, (e) => {
        e.preventDefault();
        dropArea.classList.add('highlight');
    });
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, (e) => {
        e.preventDefault();
        dropArea.classList.remove('highlight');
    });
});

dropArea.addEventListener('drop', (e) => {
    const files = e.dataTransfer.files;
    handleFiles(files);
});

fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
});

function handleFiles(files) {
    [...files].forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = () => {
            const img = document.createElement('img');
            img.src = reader.result;
            img.addEventListener('click', () => toggleFullscreen(img));
            gallery.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

function toggleFullscreen(img) {
    if (img.classList.contains('fullscreen')) {
        img.classList.remove('fullscreen');
        document.body.style.overflow = '';
    } else {
        document.querySelectorAll('#gallery img').forEach(i => i.classList.remove('fullscreen'));
        img.classList.add('fullscreen');
        document.body.style.overflow = 'hidden';
    }
}

document.getElementById('delete-photo').addEventListener('click', () => {
    const selected = document.querySelector('.fullscreen');
    if (selected) selected.remove();
});
