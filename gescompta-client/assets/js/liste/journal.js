const $nomJrnl = $('#nomJrnl');
const $dateDebut = $('#dateDebutJrnl');
const $dateFin = $('#dateFinJrnl');
const $btnJrnl = $('#btnJrnl');
const $bodyTable = $('#tbodyJrnl');


$btnJrnl.on('click', function(event) {
    if ($dateDebut.val() != '' && $dateFin.val() != '') {
        if ($dateDebut.val() > $dateFin.val()) {
            flatError('Veuillez vérifier la date de fin. Elle est inférieure à la date de début.');
        } else {
            traitementJrnl();
        }
    } else {
        flatWarning('Veuillez renseigner les dates de début et de fin.')
    }
});


var traitementJrnl = function () {
	var id = $('#nomJrnl option:selected').val();
    var debut = $dateDebut.val();
    var fin = $dateFin.val();
	$.ajax({
        url:'../../../../gescompta-api/ecriture/getForJournal.php',
        method:"POST",
        dataType: 'json',
        data:{journal : id,
              debut : debut,
              fin : fin
             },
        success : function(data) {
            if (data == "NULL") {
                flatInfo("Aucun enregistrement à afficher.");
            } else {
                // Show full page LoadingOverlay
                $.LoadingOverlay("show");

                // Hide it after 3 seconds
                setTimeout(function(){
                    $.LoadingOverlay("hide");
            	   affichageJrnl(data);
                }, 3000);
            }
        }
    });
}

var affichageJrnl = function (jsonData) {

	var dateDeb = $dateDebut.val().split('-').reverse().join('/');
    var dateF = $dateFin.val().split('-').reverse().join('/');

	$('#tabJrnl').find('caption').html('<h4>JOURNAL <strong>' + $('#nomJrnl option:selected').text() + '</strong> DU <strong>' + dateDeb + '</strong> AU <strong>' + dateF + '</strong></h4>');

	$('#tbodyJrnl').html('');
	
    var totalDebit = 0;
    var totalCredit = 0;

	$.each(jsonData, function(index,d){
        $bodyTable.append(`
            <tr>
                <td><center>${d.jour}</center></td>
                <td><center>${d.reference}</center></td>
                <td><center>${d.numCompte}</center></td>
                <td><center>${d.numExterne}</center></td>
                <td><center>${d.libelle}</center></td>
                <td><center>${d.date}</center></td>
                <td><center>${d.debit}</center></td>
                <td><center>${d.credit}</center></td>
            </tr>
        `);

        if (d.debit != ' - ') {
            totalDebit += parseInt(d.debit);    
        }

        if (d.credit != ' - ') {
            totalCredit += parseInt(d.credit);
        }
    });

    $bodyTable.append(`
        <tr>
            <td colspan="6"><center>Totaux</center></td>
            <td><center>${totalDebit}</center></td>
            <td><center>${totalCredit}</center></td>
        </tr>
    `);
}

var infoListeVide = function (msg) {

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


$(document).ready(function($) {
    $.ajax({
        url:'../../../../gescompta-api/journal/listecomplete.php',
        method:"POST",
        dataType : "json",
        success : function(data) {
            remplirComboJrnl(data);
        }
    });
});


var remplirComboJrnl = function (jsonData) {
    var options = "";
    $.each(jsonData,function(index,d){
        options += '<option value="' + d.id + '">' + d.libelle + '</option>';
    })

    $nomJrnl.html(options);
}

$('#btnImprimerJrnl').on('click', function(event) {
    $.print('#tabJrnl');
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
