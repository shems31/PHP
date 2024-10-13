// assets/js/script.js

$(document).ready(function() {
    // Exemple : afficher une alerte lorsque le formulaire de contact est soumis
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();
        // Code pour envoyer le formulaire via AJAX ou autre traitement
        Swal.fire({
            title: 'Message envoyé !',
            text: 'Votre message a été envoyé avec succès.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });

    // Exemple : gérer le clic sur le bouton "Ajouter aux favoris"
    $('.favorite-button').on('click', function() {
        var projectId = $(this).data('project-id');
        // Envoyer une requête AJAX pour ajouter le projet aux favoris
        $.post('add_favorite.php', { project_id: projectId }, function(response) {
            if (response.success) {
                toastr.success('Projet ajouté aux favoris.');
            } else {
                toastr.error('Une erreur est survenue.');
            }
        }, 'json');
    });

    // Autres scripts personnalisés
});
