document.addEventListener('DOMContentLoaded', ()=> {
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const gallery = document.getElementById('gallery');
    const deleteBtn  = document.getElementById('delete-photo');


    fetch('/photos/handleRequest')
        .then(r => r.json())
        .then(photos => {
            photos.forEach(p => {
                const img = document.createElement('img');
                img.src       = `data:${p.image_type};base64,${p.image}`;
                img.dataset.id= p.id;
                img.addEventListener('click', ()=> img.classList.toggle('selected'));
                gallery.appendChild(img);
            });
        });

    dropArea.addEventListener('click', ()=> fileInput.click());
    ['dragenter','dragover'].forEach(evt=>
        dropArea.addEventListener(evt, e=> {e.preventDefault(); dropArea.classList.add('highlight');})
    );
    ['dragleave','drop'].forEach(evt=>
        dropArea.addEventListener(evt, e=> {e.preventDefault(); dropArea.classList.remove('highlight');})
    );
    dropArea.addEventListener('drop', e=> handleFiles(e.dataTransfer.files));
    fileInput.addEventListener('change', e=> handleFiles(e.target.files));

    function handleFiles(files){
        if (!files.length) return;
        const fd = new FormData();
        fd.append('image', files[0]);
        fetch('/photos/handleRequest', {method:'POST', body:fd, credentials:'include'})
            .then(r=> r.json())
            .then(res=>{
                if(res.success) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(files[0]);
                    img.dataset.id = res.id;
                    gallery.prepend(img);
                } else {
                    alert(res.error);
                }
            });
    }

    deleteBtn.addEventListener('click', ()=>{
        const sel = gallery.querySelector('img.selected');
        if (!sel) return;
        fetch('/photos/delete_photo', {
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:`id_photo=${sel.dataset.id}`, credentials:'include'
        })
            .then(r=>r.json())
            .then(res=>{
                if(res.success) sel.remove();
            });
    });

});
