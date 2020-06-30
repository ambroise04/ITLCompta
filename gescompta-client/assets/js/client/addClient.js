const $clientFormAdd = $('#formClient');
const $submitBtnAdd = $('#btnSoumClient');


var typeClient = '';

var verify = function ($inputs) {

    addRequired();
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
    saveMinLengths($clientFormAdd);
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
        var message = 'Voulez-vous enregistrer ce client ?';
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
                    //Actualisation des tables de clients
                    tableClientP.ajax.reload();
                    tableClientM.ajax.reload();
                    //Fermeture et suppressionde la boîte de dialogue
                    $(this).dialog("close");
                    $("#dialog-confirm").remove();
                }
        }
    });
}


var envoiAjax = function () {

    //Récupération des valeurs des champs
    var nomClient = $('#nomClient').val();
    var prenomClient = $('#prenomClient').val();
    var denoClient = $('#denoClient').val();
    var numClient = $('#numClient').val();
    var emailClient = $('#emailClient').val();
    var adresseClient = $('#adresseClient').val();

    
    //Requête d'ajout du client

    if (typeClient == 'physique') {

        $.ajax({
            url:'../../../../gescompta-api/client/addClient.php',
            method:"POST",
            data:{
               action : 'add',
               nom : nomClient, 
               prenom : prenomClient,
               tel : numClient,
               email : emailClient,
               adresse : adresseClient,
               code : '411' + nomClient.charAt(0) + prenomClient.charAt(0)
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
                        testOk = false;
                        //Affichage de la boîte de dialogue
                        var msg = 'Client enregistré avec succès';
                        infoAdd(msg);
                        raz($clientFormAdd);
                    }, 3000);
                }
            } 
        });
    } else if (typeClient == 'morale') {

        $.ajax({
            url:'../../../../gescompta-api/client/addClient.php',
            method:"POST",
            data:{
               action : 'add',
               denomination : denoClient, 
               prenom : prenomClient,
               tel : numClient,
               email : emailClient,
               adresse : adresseClient,
               code : '411' + denoClient.charAt(0) + denoClient.charAt(1)
            },
            dataType : "json",
            success : function(data) { //L'enregistrement a réussi
                if(data == "OK"){ 
                    // Show full page LoadingOverlay
                    $.LoadingOverlay("show");

                    // Hide it after 3 seconds
                    setTimeout(function(){
                        $.LoadingOverlay("hide");
                        //Vidage des champs de saisie
                        raz($clientFormAdd);
                        //Pour empêcher le processus déclenché au click sur le btn soumettre
                        testOk = false;
                        //Affichage de la boîte de dialogue
                        var msg = 'Client enregistré avec succès';
                        infoAdd(msg);
                    }, 3000);
                }
            } 
        });
    }
                                
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


//Début Ajout de la classe required au champs en fonction du type de client  choisi
var addRequired = function() {

    $('#nomClient').attr('required','required');
    $('#prenomClient').attr('required','required');
    typeClient = 'physique';
    
    $('#comboTypeClient').on('change', function() {

        if ($('#comboTypeClient option:selected').text() == 'physique') {

            $('#nomClient').attr('required','required');
            $('#prenomClient').attr('required','required');
            $('#denoClient').removeAttr('required');
            typeClient = 'physique';

        } else if ($('#comboTypeClient option:selected').text() == 'morale') {

            $('#nomClient').removeAttr('required');
            $('#prenomClient').removeAttr('required');
            $('#denoClient').attr('required','required');
            typeClient = 'morale';
        }
    });
};

//Fin Ajout de la classe required au champs en fonction du type de client  choisi