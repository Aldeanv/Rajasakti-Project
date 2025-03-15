function previewImage(event) {
    var image = document.getElementById("imagePreview");
    image.src = URL.createObjectURL(event.target.files[0]);
    image.classList.remove("hidden");
}