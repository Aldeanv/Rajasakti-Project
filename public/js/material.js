function openModal(id, name, program) {
    document.getElementById("participant_id").value = id;
    document.getElementById(
        "participantInfo"
    ).textContent = `Peserta: ${name} - Program: ${program}`;
    document.getElementById("uploadModal").classList.remove("hidden");
    document.getElementById("uploadModal").classList.add("flex");
}
function closeModal() {
    document.getElementById("uploadModal").classList.add("hidden");
    document.getElementById("uploadModal").classList.remove("flex");
}
