const $ecritFormAdd = $('#formEcrit');
const $submitBtnAdd = $('#btnSoumEcrit');
const $formPrinc = $('#ecritPrinc').serialize();
const $formComp = $('#ecritComp').serialize();
const $montantEcrit = $('#montantEcrit');

var testOk = false;

$montantEcrit.on('keyup', function() {

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
    saveMinLengths($ecritFormAdd);
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
        var message = 'Voulez-vous ajouter cette écriture ?';
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
    
    var file = $("input[type=file]");
    var files = file[0].files;
    var listePieces = '';
    
    for (var i = 0; i < files.length ; i++) {
        
        listePieces += files[i].name ;
        
        if(!(i+1 == files.length)){
            listePieces+=';';
        }
    }
    
    var journalEcrit = $('.journalEcrit').val();
    var moisEcrit = $('#moisEcrit option:selected').text();
    var libelleEcrit = $('#libelleEcrit').val();
    var compteEcrit = $('.compteEcrit').val().split(' - ')[0];
    var typeEcrit = $('#typeEcrit option:selected').text();
    var montantEcrit = $('#montantEcrit').val();
    var dateEcrit = $('#dateEcrit').val();
    var codeCltFrs = $('#codeCltFrs').val();

   
    var libelleEcrit2 = $('#libelleEcrit2').val();
    var compteEcrit2 = $('#compteEcrit2').val().split(' - ')[0];
    var typeEcrit2 = $('#typeEcrit2 option:selected').text();
    var codeCltFrs2 = $('#codeCltFrs2').val();

    //Sélection du mois en chiffres(1, 2, 3,..., 12)
    $.getJSON('../assets/mois.json',function(data){
        var mois = '';
        $.each(data,function(index,d){
            if(d.lettre == moisEcrit){
                mois = d.chiffre

                //Sélection de l'id du journal correspondant au journal choisi
                var numJournalEcrit = 0;
                $.ajax({
                    url:'../../../../gescompta-api/journal/findIdByName.php',
                    method:"POST",
                    data:{journal : journalEcrit},
                    /*dataType : "json",*/
                    success : function(data) {
                        if (data == "NULL") {
                            infoAdd("Le journal saisi n'existe pas! Veuillez le créer");
                        } else {
                            $('#tableJournal').find('caption').html('JOURNAL ' + journalEcrit.toUpperCase());
                            numJournalEcrit = data;

                            //Sélection de l'id du compte correspondant au compte choisi
                            var numCompteEcrit = 0;
                            $.ajax({
                                url:'../../../../gescompta-api/compte/findNumByName.php',
                                method:"POST",
                                data:{numCompte : compteEcrit},
                                /*dataType : "json",*/
                                success : function(data) {
                                    if (data == "NULL") {
                                        infoAdd("Le compte saisi n'existe pas! Veuillez le créer");
                                    } else {
                                        numCompteEcrit = data;
                                        //Sélection de d'id du type d'écriture(débit/crédit)
                                        if (typeEcrit == 'Débit') {
                                            var numTypeEcrit = 2;
                                            var numTypeEcrit2 = 1;
                                        } else if (typeEcrit == 'Crédit') {
                                            var numTypeEcrit = 1;
                                            var numTypeEcrit2 = 2;
                                        }

                                        if(numCompteEcrit != 0 && numJournalEcrit != 0){
                                            
                                            $.ajax({
                                                url:'../../../../gescompta-api/ecriture/addEcriture.php',
                                                method:"POST",
                                                data:{
                                                   action : 'add',
                                                   journalEcrit : numJournalEcrit, 
                                                   moisEcrit : mois,
                                                   libelleEcrit : libelleEcrit,
                                                   compteEcrit : numCompteEcrit,
                                                   typeEcrit : numTypeEcrit,
                                                   montantEcrit : montantEcrit,
                                                   codeExt : codeCltFrs,
                                                   dateEcrit : dateEcrit,
                                                   pieces : listePieces,
                                                   idUser : '1' 
                                                },
                                                dataType : "json",
                                                success : function(data) {
                                                    if(data == "OK"){

                                                        //Sélection de l'id de compte de compensation correspondant au compte choisi
                                                        var numCompteEcrit2 = 0;
                                                        $.ajax({
                                                            url:'../../../../gescompta-api/compte/findNumByName.php',
                                                            method:"POST",
                                                            data:{numCompte : compteEcrit2},
                                                            /*dataType : "json",*/
                                                            success : function(data) {
                                                                if (data == "NULL") {
                                                                    infoAdd("Le compte saisi n'existe pas! Veuillez le créer");
                                                                } else {
                                                                    numCompteEcrit2 = data;
                                                                    $.ajax({
                                                                        url:'../../../../gescompta-api/ecriture/addEcriture.php',
                                                                        method:"POST",
                                                                        data:{
                                                                           action : 'add',
                                                                           journalEcrit : numJournalEcrit, 
                                                                           moisEcrit : mois,
                                                                           libelleEcrit : libelleEcrit2,
                                                                           compteEcrit : numCompteEcrit2,
                                                                           typeEcrit : numTypeEcrit2,
                                                                           montantEcrit : montantEcrit,
                                                                           codeExt : codeCltFrs2,
                                                                           dateEcrit : dateEcrit,
                                                                           pieces : listePieces,
                                                                           idUser : '1' 
                                                                        },
                                                                        dataType : "json",
                                                                        success : function(data) {
                                                                            if(data == "OK"){
                                                                                // Show full page LoadingOverlay
                                                                                $.LoadingOverlay("show");

                                                                                // Hide it after 3 seconds
                                                                                setTimeout(function(){
                                                                                    $.LoadingOverlay("hide");
                                                                                    
                                                                                    var msg = 'Ecriture ajouté avec succès';
                                                                                    
                                                                                    infoAdd(msg);
                                                                                    raz($ecritFormAdd);  
                                                                                    testOk = false;
                                                                                }, 3000);
                                                                            }
                                                                        },
                                                                    });
                                                                }
                                                            }
                                                        });
                                                    }
                                                } 
                                            });
                                        }
                                    }
                                    
                                }
                            });
                        }
                    }
                });
            };
        });
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


//Remplissage automatique des champs

$('#tags').on('keyup', function() {
    $('#jrnlEcrit2').val($(this).val())
});


$('#moisEcrit').on('change', function() {
    $('#moisEcrit2 option:selected').val($('#moisEcrit option:selected').val());
    $('#moisEcrit2 option:selected').text($('#moisEcrit option:selected').text());
});


$('#montantEcrit').on('keyup', function() {
    $('#montantEcrit2').val($(this).val())
});

$('#typeEcrit').on('change', function() {

    if ($('#typeEcrit option:selected').text() == 'Crédit') {

        $('#typeEcrit2 option:selected').text('Débit');
    
    } else {
    
        $('#typeEcrit2 option:selected').val('charge');
        $('#typeEcrit2 option:selected').text('Crédit');
    }
});


$('#dateEcrit').on('change', function() {
    $('#dateEcrit2').val($(this).val())
});


$('#codeCltFrs').on('keyup', function() {
    if ($(this).val() != '') {
        $('#codeCltFrs2').val('R')
    } else {
        $('#codeCltFrs2').val('')
    }
});
