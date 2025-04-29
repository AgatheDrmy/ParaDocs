document.addEventListener('DOMContentLoaded', function() {
    // upload de photo
    const photoInput = document.getElementById('photo-input');
    const photoTrigger = document.getElementById('photo-trigger');
    
    if (photoInput && photoTrigger) {
        photoTrigger.addEventListener('click', function() {
            photoInput.click();
        });
        
        photoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // Afficher l'aperçu
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.pdp').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
                
                // Soumettre le formulaire
                document.getElementById('photo-form').submit();
            }
        });
    }
    
    // validation du mot de passe
    const passwordForm = document.getElementById('password-form');
    const newPassword = document.getElementById('new-password');
    
    if (passwordForm && newPassword) {
        passwordForm.addEventListener('submit', function(event) {
            if (!newPassword.value || newPassword.value.length < 8) {
                event.preventDefault();
                alert('Le mot de passe doit contenir au moins 8 caractères');
            }
        });
    }
});