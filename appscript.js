$(document).ready(function () {
  $('table').DataTable({

    "language": {
      "sEmptyTable": "Aucune donnée disponible dans le tableau",
      "sInfo": "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
      "sInfoEmpty": "Affichage de l'élément 0 à 0 sur 0 élément",
      "sInfoFiltered": "(filtré à partir de _MAX_ éléments au total)",
      "sInfoPostFix": "",
      "sInfoThousands": ",",
      "sLengthMenu": "Afficher _MENU_ éléments",
      "sLoadingRecords": "Chargement...",
      "sProcessing": "Traitement...",
      "sSearch": "Rechercher :",
      "sZeroRecords": "Aucun élément correspondant trouvé",
      "oPaginate": {
        "sFirst": "Premier",
        "sLast": "Dernier",
        "sNext": "Suivant",
        "sPrevious": "Précédent"
      },
      "oAria": {
        "sSortAscending": ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
      },
      "select": {
        "rows": {
          "_": "%d lignes sélectionnées",
          "0": "Aucune ligne sélectionnée",
          "1": "1 ligne sélectionnée"
        }
      }

    },
    order: [0, 'desc']
  });

  showAllArticles();

  function showAllArticles() {
    $.ajax({
      url: "action.php",
      type: "POST",
      data: {
        action: "view"
      },
      success: function (response) { // console.log(response);

        $("#showArticles").html(response);
      }
    });
  }

  // creation d un article requête ajax

  $("#insert").click(function (e) {
    if ($("#form-data")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "action.php",
        type: "POST",
        data: $("#form-data").serialize() + "&action=insert",
        success: function (response) { // console.log(response);
          Swal.fire({title: 'Article ajouté avec succès !', type: 'success'});

          $("#addModal").modal('hide');
          $("#form-data")[0].reset();
          showAllArticles();
        }
      })
    }
  })

  // modification d'un article
  $("body").on("click", ".editBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr('id');
    $.ajax({
      url: "action.php",
      type: "POST",
      data: {
        edit_id: edit_id
      },
      success: function (response) { // console.log(response);
        data = JSON.parse(response);
        // console.log(data);
        $("#id").val(data.id); // à ce niveau data est sous forme de clef:valeur
        $("#title").val(data.title);
        $("#description").val(data.description);
        $("#price").val(data.price);
        $("#author").val(data.author);

      }
    });
  });

  // mis à jour de l'article


  $("#update").click(function (e) {
    if ($("#edit-form-data")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "action.php",
        type: "POST",
        data: $("#edit-form-data").serialize() + "&action=update",
        success: function (response) { // console.log(response);
          Swal.fire({title: 'Article modifié avec succès !', type: 'success'});

          $("#editModal").modal('hide');
          $("#edit-form-data")[0].reset();
          showAllArticles();
        }
      })
    }
  })

  // suppression d'article

  $("body").on("click", ".delBtn", function (e) {
    e.preventDefault();
    var tr = $(this).closest('tr');
    del_id = $(this).attr('id');

    Swal.fire({
      title: 'Etes vous sûr?',
      text: "Opération irréversible!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Oui, supprimé!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {
            del_id: del_id
          },
          success: function (response) {
           // console.log(response);
            tr.css('background-color','#ff6666')
            Swal.fire(
              'Suppression!',
              'Article supprimé avec succès',
              'success',
            )
            showAllArticles();
          }
        });

      }

    });
  });

  // détails de l'article

  $("body").on("click",".infoBtn",function(e){
    e.preventDefault();
    info_id = $(this).attr('id');
    $.ajax({
      url: "action.php",
      type: "POST",
      data: {
        info_id: info_id
      },
      success: function (response) {
        //console.log(response);
        data = JSON.parse(response);
        Swal.fire({
            title:'<strong>Info Article : ID('+data.id+')</strong>',
            type:'info',
            html:'<b>Titre :</b>'+data.title+
            '<br><b>Description :</b>'+data.description+
            '<br><b>Prix :</b>'+data.price+
            '<br><b>Auteur :</b>'+data.author,
            showCancelButton:true,
        })
      }
    });

  })

});
