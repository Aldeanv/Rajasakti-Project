function validateFiles(event) {
    const fileInput = event.target;
    const files = fileInput.files;
    const previewContainer = document.getElementById('imagePreviewContainer');
    const errorMsg = document.getElementById('file-error');
    const maxSize = 2 * 1024 * 1024; // 2MB dalam byte
    const allowedExtensions = ['jpg', 'jpeg', 'png']; // Format yang diperbolehkan

    // Reset preview container & error message
    previewContainer.innerHTML = "";
    errorMsg.classList.add('hidden');

    if (files.length > 0) {
        for (let file of files) {
            const fileSize = file.size;
            const fileName = file.name.toLowerCase();
            const fileExtension = fileName.split('.').pop();

            // Cek ukuran file
            if (fileSize > maxSize) {
                errorMsg.textContent = "Salah satu file melebihi ukuran 2MB!";
                errorMsg.classList.remove('hidden');
                fileInput.value = ''; // Reset input file
                return;
            }

            // Cek format file
            if (!allowedExtensions.includes(fileExtension)) {
                errorMsg.textContent = "Salah satu file memiliki format tidak diperbolehkan! Hanya JPG & PNG.";
                errorMsg.classList.remove('hidden');
                fileInput.value = ''; // Reset input file
                return;
            }

            // Jika validasi berhasil, tampilkan preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-32', 'h-32', 'object-cover', 'rounded-lg', 'shadow-md');
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }
}