const $depenseFormAdd = $('#formDepense');
const $btnSoumDepense = $('#btnSoumDepense');
const $montde = $('#montantDep');

var $selectEcritDep = $('#ecritDep');

var testOk = false;

$montde.on('keyup', function() {

    var input = $(this).val();
    var regex = new RegExp("[0-9]+");

    if (!regex.test(input)) {
          $(this).val(input.substr(0, input.length-1));
    }
});

var verifyDep = function ($inputs) {

    $inputs.each(function (key, input) {
        $(input).on('focusout', function (event) {
            if ($.trim($(input).val()).length == 0) {
                // Pas correct -> afficher l'erreur
                $(input).parent().parent().find('p').removeClass('hidden');
            } else {
                // Correct -> cacher l'erreur
                $(input).parent().parent().find('p').addClass('hidden');
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

            if ($('[valid=true]').length+1 == $inputs.length) {
                testOk = true;
            } else {
                testOk = false;
            }
        });
        
    });
    
};



$(document).ready(function (event) {
    // Au chargement de la page
    saveMinLengthsDep($depenseFormAdd);
});


var saveMinLengthsDep = function ($jqForm) {
    const $inputs = $jqForm.find('input[required]');
 
    // Vérifier et watch à chaque changement
    verifyDep($inputs);
};


// Requête AJAX
$btnSoumDepense.click(function(event) { 
    event.preventDefault();

    if (testOk) {

        //Lancement d'AJAX par la méthode post
        var message = 'Voulez-vous enregistrer cette dépense ?';
        confirmAddDep(message)
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
    
    
    var nomFrs = $('#frsDep').val();
    var compteDep = $('#compteDep').val();
    var montantDep = $('#montantDep').val();
    var dateDep = $('#dateDep').val();
    var descDep = $('#descDep').val();
    var ecritDep = $('#ecritDep option:selected').val();

    //Test d'existence du fournisseur saisi
    $.ajax({
        url:'../../../../gescompta-api/fournisseur/findCodeFrsByName.php',
        method:"POST",
        data:{nomFrs : nomFrs},
        success : function(data) {
            if (data == "NULL") {
                infoAdd("Le fournisseur saisi n'existe pas! Veuillez le créer");
            } else {
                nomFrs = data;
                //Sélection du numéro de compte
               /* $.ajax({
                    url:'../../../../gescompta-api/typereglement/findIdByName.php',
                    method:"POST",
                    data:{nomFrs : },
                    success : function(data) {
                        typeReg = data;
                        */
                        //Requête d'ajout du règlement
                        $.ajax({
                            url:'../../../../gescompta-api/operation/addCharge.php',
                            method:"POST",
                            data:{
                               action : 'add',
                               nomFrs : nomFrs, 
                               compteDep : compteDep,
                               montantDep : montantDep,
                               dateDep : dateDep,
                               descDep : descDep,
                               ecritDep : ecritDep 
                            },
                            dataType : "json",
                            success : function(data) {

                                if(data == "OK"){
                                    // Show full page LoadingOverlay
                                    $.LoadingOverlay("show");

                                    // Hide it after 3 seconds
                                    setTimeout(function(){
                                        $.LoadingOverlay("hide");
                                        //Vidage des champs de saisie
                                        //Pour empêcher le processus déclenché au click sur le btn soumettre
                                        testOk = false;$select.html('');
                                        //Affichage de la boîte de dialogue
                                        var msg = 'Charge enregistrée avec succès';
                                        infoAdd(msg);
                                        raz($depenseFormAdd);
                                    }, 3000);
                                }
                            } 
                        });
                    
                    //}
                //});        
            }
        }
    });
}

var confirmAddDep = function (message) {
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

$('#frsDep').on('keyup', function() {
    var nomFrs = $(this).val();
    
    if (nomFrs != "") {

        $.ajax({
            url:'../../../../gescompta-api/ecriture/findEcritByFrs.php',
            method:"POST",
            data:{nomFrs : nomFrs},
            dataType : "json",
            success : function(data) {
                if (data != "NULL") {
                    remplirComboEcrit(data);
                }
            }
        });

    } else {
        $selectEcritDep.html('');
    }
    
});


var remplirComboEcrit = function (jsonData) {
    var options = "";
    $.each(jsonData,function(index,d){
        options += '<option value="' + d.idEcrit + '">' + d.libelle + '</option>';
        idEcrit = d.idEcrit;
    })
    $selectEcritDep.html(options);
}

