const $formAdd = $('#formChangePass');

const $submitBtnAdd = $('#btnChangePass');

const $ancienPass = $('#ancienPass');
const $newPass = $('#newPass');
const $confNewPass = $('#confNewPass');

var testOk = false;

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
    saveMinLengths($formAdd);
});


var saveMinLengths = function ($jqForm) {
    const $inputs = $jqForm.find('input[required]');
 
    // Vérifier et watch à chaque changement
    verify($inputs);
};


// Requête AJAX
var user = '';
$submitBtnAdd.click(function(event) { 
    event.preventDefault();

    if($newPass.val() != $confNewPass.val()){

        flatError('Le nouveau mot de passe et sa confirmation ne sont pas identiques.')

    } else if (testOk) {

        var message = 'Voulez-vous valider cette modification ?';

        $.ajax({
            url:'../../../../gescompta-api/session/getConnected.php',
            method:"POST",
            dataType : "json",
            success : function(data) {
                if (data != "NULL") {
                    user = data.login;
                    confirmAdd(message)
                } else {
                    //Redirection vers la page de connexion
                    window.location.href = "../index.php";
                }
            } 
        });


    } else {
        flatWarning('Veuillez renseigner correctement tous les champs');
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
    
    var ancien = $ancienPass.val();
    var nouveau = $newPass.val();

    $.ajax({
        url:'../../../../gescompta-api/parametre/updatePass.php',
        method:"POST",
        data:{
            ancien : ancien,
            user : user
        },
        
        success : function(data) {
            if (data == "NULL") {
                flatError("Ancien mot de passe incorrect !");
            } else {
                $.ajax({
                    url:'../../../../gescompta-api/parametre/updatePass.php',
                    method:"POST",
                    data:{
                       action : 'update',
                       user : user,
                       nouveau : nouveau
                    },
                    dataType : "json",
                    success : function(data) {
                        if(data == "OK"){
                            // Show full page LoadingOverlay
                            $.LoadingOverlay("show");

                            // Hide it after 3 seconds
                            setTimeout(function(){
                                $.LoadingOverlay("hide");
                                raz($formAdd);
                                flatSuccess('Votre mot de passe a été changé avec succès');
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


$ancienPass.on('keyup', function(event) {
    if ($(this).val() == '') {
        $(this).parent().find('label').fadeOut();
    } else {
         $(this).parent().find('label').fadeIn('');
    }
});

$newPass.on('keyup', function(event) {
    if ($(this).val() == '') {
        $(this).parent().find('label').fadeOut();
    } else {
         $(this).parent().find('label').fadeIn('');
    }
});

$confNewPass.on('keyup', function(event) {
    if ($(this).val() == '') {
        $(this).parent().find('label').fadeOut();
    } else {
         $(this).parent().find('label').fadeIn('');
    }
});

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

