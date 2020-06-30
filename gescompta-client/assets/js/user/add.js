const $userFormAdd = $('#formUser');
const $submitBtnAdd = $('#btnSoumUser');
 var testOk = false;

var verify = function ($inputs) {

    $inputs.each(function (key, input) {
        $(input).on('focusout', function (event) {
            if ($(input).val().length < input.minLength) {
                // Pas correct -> afficher l'erreur
                $(input).parent().parent().find('p').removeClass('hidden');
            } else {
                // Correct -> cacher l'erreur
                $(input).parent().parent().find('p').addClass('hidden');
            }
        });
 
        $(input).on('keyup', function (event) {
            if (!($(input).val().length < input.minLength)) {
                // Correct -> cacher l'erreur
                $(input).parent().parent().find('p').addClass('hidden');
                $(input).attr('valid', 'true');
            } else {
                
                $(input).attr('valid', 'false');
            }
            
            if ($('[valid=true]').length === $inputs.length) {
                testOk = true;
            } else {
                testOk = false;
            }
        });
        
    });
    
};



$(document).ready(function (event) {
    // Au chargement de la page
    saveMinLengths($userFormAdd);
});


var saveMinLengths = function ($jqForm) {
    const $inputs = $jqForm.find('input[required]');
 
    // Vérifier et watch à chaque changement
    verify($inputs);
};


// Requête AJAX
$submitBtnAdd.click(function(event) { 
    event.preventDefault();

    if (testOk) {

        //Lancement d'AJAX par la méthode post
        var message = 'Voulez-vous ajouter cet utilisateur ?';
        confirmAdd(message)
    } else {
        infoAdd('Veuillez renseigner correctement tous les champs');
    }
                
});            


var infoAdd = function (msg) {

    $('body').append('<div id="dialog-confirm" title="Information"></div>');

    $("#dialog-confirm").html(msg);
    
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:160,
        width:500,
        autoOpen: true,
        modal: true,
        buttons: {
                "Ok": function() {
                    $(this).dialog("close");
                    $("#dialog-confirm").remove();
                }
        }
    });
}

var envoiAjax = function () {
    var nom = $('#nomUser').val();
    var prenom = $('#prenomUser').val();
    var login = $('#loginUser').val();
    var passe = $('#passeUser').val();
    var email = $('#emailUser').val();
    var image = $('#photoUser').val();
    var typeUser = '';

    if ($('#comboTypeUser option:selected').val() == "1") {
        typeUser = 1
    } else if ($('#comboTypeUser option:selected').val() == "2"){
        typeUser = 2
    } else {
        typeUser = 3
    }

    $.ajax({
        url:'../../../../gescompta-api/users/addUser.php',
        method:"POST",
        data:{
           action : 'add',
           nom : nom, 
           prenom : prenom,
           login : login,
           passe : passe,
           email : email,
           image : image,
           typeUser : typeUser
        },
        dataType : "json",
        success : function(data) {
            // Show full page LoadingOverlay
            $.LoadingOverlay("show");

            // Hide it after 3 seconds
            setTimeout(function(){
                $.LoadingOverlay("hide");
                tableUser.ajax.reload();
                
                var msg = 'Utilisateur ajouté avec succès';   
                
                infoAdd(msg);
            }, 3000);
        } 
    });
    testOk = false;
}

var confirmAdd = function (message) {
    $('body').append('<div id="dialog-confirm" title="Confirmation"></div>');

    $("#dialog-confirm").html(message);
    
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:160,
        width:500,
        autoOpen: true,
        modal: true,
        buttons: {
            "Oui": function(){
                    envoiAjax();
                    raz($userFormAdd);
                    $(this).dialog("close");
                    $("#dialog-confirm").remove();
            },
            "Non": function() {               
               $(this).dialog("close");
               $("#dialog-confirm").remove();
            }
        }
    });
}