document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        let successAlert = document.querySelector('.bg-green-500');
        if (successAlert) {
            successAlert.style.transition = "opacity 0.5s ease-out";
            successAlert.style.opacity = "0";
            setTimeout(() => successAlert.remove(), 500);
        }
    }, 3000);
});