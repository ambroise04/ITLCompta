const $journalFormAdd = $('#formJournal');
const $submitBtnAdd = $('#btnAddJournal');
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
    saveMinLengths($journalFormAdd);
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
        var message = 'Voulez-vous créer ce journal ?';
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
    
    var libelleJ = $('#libelleJ').val();
    var codeJ = $('#codeJ').val();
    var dateDebutJ = $('#dateDebutJ').val();
    var dateFinJ = $('#dateFinJ').val();
    var exoJ = $('#exoJ').val();

    $.ajax({
        url:'../../../../gescompta-api/exercice/findDateExoByAnnee.php',
        method:"POST",
        data:{exercice : exoJ},
        
        success : function(data) {
            if (data == "NULL") {
                infoAdd("L'exercice saisi n'existe pas! Veuillez le créer");
            } else {
                $.ajax({
                    url:'../../../../gescompta-api/journal/addJournal.php',
                    method:"POST",
                    data:{
                       action : 'add',
                       libelleJ : libelleJ, 
                       codeJ : codeJ,
                       dateDebutJ : dateDebutJ,
                       dateFinJ : dateFinJ,
                       exoJ : data
                    },
                    dataType : "json",
                    success : function(data) {
                        if(data == "OK"){
                            // Show full page LoadingOverlay
                            $.LoadingOverlay("show");

                            // Hide it after 3 seconds
                            setTimeout(function(){
                                $.LoadingOverlay("hide");
                                tableJournal.ajax.reload();
                                allJournal.ajax.reload();
                                
                                raz($journalFormAdd);  
                                
                                var msg = 'Journal ajouté avec succès';
                                
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
