const $formAdd = $('#formExo');
const $submitBtnAdd = $('#btnAddExo');
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
        var message = 'Voulez-vous ajouter cet exercice ?';
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
    
    var annee = $('#anneeExo').val();
    var libelle = $('#libelleExo').val();

    $.ajax({
        url:'../../../../gescompta-api/exercice/findExoByAnnee.php',
        method:"POST",
        data:{annee : annee},
        
        success : function(data) {
            if (data != "NULL") {
                infoAdd("L'année saisie existe déjà!");
            } else {
                $.ajax({
                    url:'../../../../gescompta-api/exercice/addExo.php',
                    method:"POST",
                    data:{
                       action : 'add',
                       annee : annee, 
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
                                tableFrs.ajax.reload();
                                
                                raz($formAdd);  
                                
                                var msg = 'Exercice ajouté avec succès';
                                
                                infoAdd(msg);
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
