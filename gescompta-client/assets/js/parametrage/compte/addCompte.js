const $formAddCompte = $('#formCompte');
const $submitBtnCompte = $('#btnAddCompte');

const $numCompte = $('#num');
const $libCompte = $('#libelle');

var testOk = false;


$('input:radio[name="compte"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'manuel') {
            $('#partieManuel').removeClass('hidden');
            $('#partieFichier').addClass('hidden');
        } else {
            $('#partieFichier').removeClass('hidden');
            $('#partieManuel').addClass('hidden');
        }
});

$numCompte.on('keyup', function() {

    var input = $(this).val();
    var regex = new RegExp("[0-9]+");

    if (!regex.test(input)) {
          $(this).val(input.substr(0, input.length-1));
    }
});

var verify = function ($inputs) {

    $inputs.each(function (key, input) {
        $(input).on('focusout', function (event) {
            if ($.trim($(input).val()).length == 0) {
                // Pas correct -> afficher l'erreur
                $(input).parent().parent().find('p').removeClass('hidden');
                $(input).attr('valid', 'false');
            } else {
                // Correct -> cacher l'erreur
                $(input).parent().parent().find('p').addClass('hidden');
                $(input).attr('valid', 'true');
            }
        });
 
        $(input).on('keyup', function (event) {
            if (!$.trim($(input).val()).length == 0) {
                // Correct -> cacher l'erreur
                $(input).parent().parent().find('p').addClass('hidden');
                $(input).attr('valid', 'true');
            } else {
                
                $(input).attr('valid', 'false');
            }

            if ($('[valid=true]').length == $inputs.length) {
                testOk = true;
            } else {
                testOk = false;
            }
        });
        
    });
    
};



$(document).ready(function (event) {
    // Au chargement de la page
    $('#partieFichier').addClass('hidden');
    saveMinLengths($formAddCompte);
});


var saveMinLengths = function ($jqForm) {
    const $inputs = $jqForm.find('input[manuel]');
 
    // Vérifier et watch à chaque changement
    verify($inputs);
};


// Requête AJAX
$submitBtnCompte.click(function(event) { 
    event.preventDefault();

    if (testOk) {

        //Lancement d'AJAX par la méthode post
        var message = 'Voulez-vous ajouter ce compte ?';
        confirmAdd(message)
    } else {
        flatWarning('Veuillez renseigner correctement tous les champs');
    }
                
});            

$numCompte.on('keyup', function(event) {
    if ($(this).val() == '') {
        $(this).parent().find('label').fadeOut();
    } else {
         $(this).parent().find('label').fadeIn('');
    }
});

$libCompte.on('keyup', function(event) {
    if ($(this).val() == '') {
        $(this).parent().find('label').fadeOut();
    } else {
         $(this).parent().find('label').fadeIn('');
    }
});

var envoiAjax = function () {
    
    var numero = $numCompte.val();
    var libelle = $libCompte.val();
    

    $.ajax({
        url:'../../../../gescompta-api/compte/getCompte.php',
        method:"POST",
        data:{numero : numero}, 
        success : function(data) {
            if (data == "OUI") {
                flatInfo("Ce compte existe déjà !");
            } else if(data == "NON") {
                $.ajax({
                    url:'../../../../gescompta-api/compte/addCompte.php',
                    method:"POST",
                    data:{
                        numero : numero,
                        libelle : libelle
                    },
                    dataType : "json",
                    success : function(data) {
                        if(data == "OK"){
                            // Show full page LoadingOverlay
                            $.LoadingOverlay("show");

                            // Hide it after 3 seconds
                            setTimeout(function(){
                                $.LoadingOverlay("hide");
                                raz($formAddCompte);  
                                var msg = 'Compte enregistré avec succès';
                                flatSuccess(msg);
                                testOk = false;
                            }, 3000);
                        }
                    } 
                });
            }
        }
    });
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

var raz = function ($formulaire) {
    $formInputs = $formulaire.find('input');
    $formSelect = $formulaire.find('select');
    $formTextarea = $formulaire.find('textarea');
    
    $formInputs.each(function (key, input) {
        $(input).val('');
    });

    $formSelect.each(function (key, select) {
        $(select).val('1');
    });

    $formTextarea.each(function (key, textarea) {
        $(textarea).val('');
    });

}


var flatError = function (msg) {
    displayNotification('error', msg, 3000);
}

var flatInfo = function (msg) {
    displayNotification('info', msg, 3000);
}

var flatSuccess = function (msg) {
    displayNotification('success', msg, 3000);
}

var flatWarning = function (msg) {
    displayNotification('warning', msg, 3000);
}