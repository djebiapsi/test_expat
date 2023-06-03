$(document).ready(function() {
  $('#publish').click(function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    var title = $('#title').val();
    var content = $('#content').val();
    var category = ($('#category').val() != 0) ? $('#category').val() : null;

    
    // Vérifier la validité des champs
    var form = $('form')[0];
    if (form.checkValidity()) {
      // Les champs sont valides, procéder à l'appel Ajax
      $.ajax({
        url: '../Service/newArticle.php', // URL du script de traitement PHP
        type: 'POST',
        data: {
          title: title,
          content: content,
          category: category
        },
        success: function(response) {
          // Réponse du serveur
          $('#resultat').html(response);
          if (category != null) {
            document.location.href = "index.php?categoryId=" + category;
          } else {
            document.location.href = "index.php";
          }
        }
      });
    } else {
      // Afficher un message d'erreur si les champs ne sont pas valides
    var errorMessage = $('<div>').addClass('alert alert-danger').text('Veuillez remplir tous les champs obligatoires');
    $('body').prepend(errorMessage);;
    }
  });
});
