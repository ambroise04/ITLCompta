const $reglmtFormAdd = $('#formReglement');
const $submitBtnAdd = $('#btnSoumReg');
const $select = $('#listeProjetClient');
const $selEcrit = $('#ecritReg');
const $mont = $('#montantReg');

var ancienSolde = 0;
var montantDu = 0;
var newSolde = 0;
var montantRegle = 0;
var totalRegle = 0;
var resteAPayer = 0;

var idClient = 0;
var idProjet = 0;



var testOk = false;

$mont.on('keyup', function() {

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
    saveMinLengths($reglmtFormAdd);
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
        var message = 'Voulez-vous enregistrer ce règlement ?';
        confirmAdd(message)
    } else {
        infoAdd('Veuillez renseigner correctement tous les champs');
    }
                
});            


var infoAdd = function (msg,libelle) {

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
                    postAction(libelle);
                    $(this).dialog("close");
                    $("#dialog-confirm").remove();
                }
        }
    });
}

var envoiAjaxReg = function () {
    
    
    var nomClientReg = $('#nomClientReg').val();
    var projetClient = $('#listeProjetClient option:selected').text();
    var typeReg = $('#typeReg option:selected').text();
    var dateReg = $('#dateReg').val();
    var ecritReg = $('#ecritReg option:selected').val();
    var montantReg = $('#montantReg').val();
    var commentReg = $('#commentReg').val();
    idProjet = $('#listeProjetClient option:selected').val();

    montantRegle = montantReg;

    //Test d'existence du client saisi
    $.ajax({
        url:'../../../../gescompta-api/projet/findProjetByClient.php',
        method:"POST",
        data:{client : nomClientReg},
        success : function(data) {
            if (data == "NULL") {
                infoAdd("Le client saisi n'existe pas! Veuillez le créer");
            } else {

                $('#reglmtClientTable').find('caption').html('LISTE DES REGLEMENTS DE <strong>' + nomClientReg + ' - PROJET ' + projetClient + '</strong>');
                nomClientReg = idClient;

                //Sélection de d'id du type de règlement
                $.ajax({
                    url:'../../../../gescompta-api/typereglement/findIdByName.php',
                    method:"POST",
                    data:{typeReg : typeReg},
                    success : function(data) {
                        typeReg = data;
                        
                        //Requête d'ajout du règlement
                        $.ajax({
                            url:'../../../../gescompta-api/operation/addReglement.php',
                            method:"POST",
                            data:{
                               action : 'add',
                               nomClientReg : nomClientReg, 
                               projetClient : idProjet,
                               typeReg : typeReg,
                               dateReg : dateReg,
                               ecritReg : ecritReg,
                               montantReg : montantReg,
                               commentReg : commentReg 
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
                                        raz($reglmtFormAdd);
                                        //Pour empêcher le processus déclenché au click sur le btn soumettre
                                        testOk = false;
                                        //Vidage du combo des projet du client  
                                        $select.html('');
                                        //Affichage de la boîte de dialogue
                                        var msg = 'Règlement enregistré avec succès';
                                        infoAdd(msg,projetClient);
                                    }, 3000);
                                }
                            } 
                        });
                    
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
                    envoiAjaxReg();
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

$('#nomClientReg').on('keyup', function() {
    var nomprenom = $(this).val().split(' ');
    var nomClient = nomprenom[0];
    var prenomClient = "";

    for (var i = 1; i < nomprenom.length; i++) {
        if (i+1 != nomprenom.length) {
            prenomClient = nomprenom[i] + ' ';    
        } else {
            prenomClient = nomprenom[i];
        }
        
    }
    
    if (nomClient != "") {

        $.ajax({
            url:'../../../../gescompta-api/projet/findProjetByClient.php',
            method:"POST",
            data:{nomClient : nomClient, prenomClient : prenomClient},
            dataType : "json",
            success : function(data) {
                if (data != "NULL") {
                    remplirCombo(data);
                }
            }
        });

        $.ajax({
            url:'../../../../gescompta-api/ecriture/findEcritByCode.php',
            method:"POST",
            data:{nomClient : nomClient, prenomClient : prenomClient},
            dataType : "json",
            success : function(data) {
                if (data != "NULL") {
                    comboEcrit(data);
                }
            }
        });

    } else{
        $select.html('');
        $selEcrit.html('');
    }
    
});


var remplirCombo = function (jsonData) {
    var options = "";
    $.each(jsonData,function(index,d){
        options += '<option value="' + d.idProjet + '">' + d.libelle + '</option>';
        idClient = d.idClient;
    })

    $select.html(options);

}

var comboEcrit = function (jsonData) {
    var options = "";
    $.each(jsonData,function(index,d){
        options += '<option value="' + d.idEcrit + '">' + d.libelle + '</option>';
    })

    $selEcrit.html(options);
}

var postAction = function (libelle) {

    //Recherche du coût total du projet
    $.ajax({
        url:'../../../../gescompta-api/projet/getMontantProjet.php',
        method:"POST",
        data:{
           projet : libelle},
        dataType : "json",
        success : function(data) {
            if(data != "NULL") {
                montantDu = data;

                //Recherche du total des règlement du projet
                $.ajax({
                    url:'../../../../gescompta-api/operation/getTotalByProjet.php',
                    method:"POST",
                    data:{
                       projet : idProjet},
                    dataType : "json",
                    success : function(data) {
                        if(data != "NULL") {
                            totalRegle = parseInt(data);
                            newSolde = parseInt(montantDu) - parseInt(totalRegle);
                            ancienSolde = parseInt(newSolde) + parseInt(montantRegle);

                            //Remplissage des champs d'information
                            $('#montantProjet').val(montantDu);
                            $('#ancienSolde').val(ancienSolde);
                            $('#newSolde').val(newSolde);

                            //Cacher le formulaire
                            $('.toHide').hide('2000', function() {
                                //Affichage des champs
                                $('#etatReglemt').show();
                            });

                            //Remplissage du tableau des règlements du client
                            tableReglement.ajax.reload();
                        }
                    } 
                });

            }
        } 
    });

}

$('#bntAutreReg').on('click', function(event) {
    $('#etatReglemt').hide('2000', function() {
        $('.toHide').show();  
        //stableReglement.ajax.reload();
    });
});



var tableReglement = $("#reglmtClientTable").DataTable({
    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/operation/listeReglementsClient.php",
        method : "POST",
        data: {montantTotal : montantDu, idProjet : idProjet}
    }
});


/*$('#montantDu1').val(montantDu);
$('#totalReglemt').val(totalRegle);
$('#resteAPayer').val(montantDu - totalRegle);*/