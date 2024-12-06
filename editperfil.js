function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePicPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// Handle form submission (just to prevent refresh and show an alert for now)
document.getElementById('editProfileForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert("Perfil atualizado com sucesso!");
});