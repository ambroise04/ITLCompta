const $formAdd = $('#formFrs');
const $submitBtnAdd = $('#btnAddFrs');
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
$submitBtnAdd.click(function(event) { 
    event.preventDefault();

    if (testOk) {

        //Lancement d'AJAX par la méthode post
        var message = 'Voulez-vous ajouter ce fournisseur ?';
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
    
    var nomFrs = $('#nomFrs').val();
    var code = '401' + nomFrs.charAt(0).toUpperCase() + nomFrs.charAt(1).toUpperCase();
    var tel = $('#numFrs').val();
    var adresseFrs = $('#adresseFrs').val();
    var email = $('#emailFrs').val();

    $.ajax({
        url:'../../../../gescompta-api/fournisseur/findCodeFrsByName.php',
        method:"POST",
        data:{nomFrs : nomFrs},
        
        success : function(data) {
            if (data != "NULL") {
                infoAdd("Le nom de fournisseur saisi existe déjà!");
            } else {
                $.ajax({
                    url:'../../../../gescompta-api/fournisseur/addFrs.php',
                    method:"POST",
                    data:{
                       action : 'add',
                       nom : nomFrs, 
                       code : code,
                       tel : tel,
                       adresse : adresseFrs,
                       email : email
                    },
                    dataType : "json",
                    success : function(data) {
                        if(data == "OK"){
                            // Show full page LoadingOverlay
                            $.LoadingOverlay("show");

                            // Hide it after 3 seconds
                            setTimeout(function(){
                                $.LoadingOverlay("hide");
                                var msg = 'Fournisseur ajouté avec succès';
                                infoAdd(msg);
                                raz($formAdd);  
                                tableFrs.ajax.reload();
                            }, 3000);

                            testOk = false;
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
