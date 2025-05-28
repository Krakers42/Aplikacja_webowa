const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('fileElem');
const gallery = document.getElementById('gallery');


window.onload = () => {
    fetch('controllers/PhotoController.php')
        .then(res => res.json())
        .then(photos => {
            photos.forEach(photo => {
                const img = document.createElement('img');
                img.src = `data:${photos.image_type};base64,${photos.image}`;
                gallery.appendChild(img);
            });
        })
        .catch(error => {
            console.error('There was a problem with loading photos:', error);
        });
};

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
    const formData = new FormData();
    formData.append('photo', file);

    fetch('controllers/PhotoController.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                displayImage(file);
            } else {
                console.error('Error with uploading:', data.error);
            }
        })
        .catch(error => {
            console.error('Upload failed:', error);
        });
}

function displayImage(file) {
    const reader = new FileReader();
    reader.onload = () => {
        const img = document.createElement('img');
        img.src = reader.result;
        gallery.appendChild(img);
    };
    reader.readAsDataURL(file);
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
