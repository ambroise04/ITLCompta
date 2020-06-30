const $tabBal = $('#tabBal');
const $bodyBal = $('#tbodyBal');
const $bntAfficheBal = $('#btnBal');
const $dateInf = $('#dateDebutBal');
const $dateSup = $('#dateFinBal');

$bntAfficheBal.on('click', function(event) {
	
    if ($dateInf.val() != '' && $dateSup.val() != '') {

        if ($dateInf.val() > $dateSup.val()) {
            flatError('Veuillez vérifier la date de fin. Elle est inférieure à la date de début.');
        } else {
            traitementBal();
        }
    } else {
        flatError('Veuillez renseigner les deux dates!');
    }
});

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

var traitementBal = function () {
	
    var debut = $dateInf.val();
    var fin = $dateSup.val();
	$.ajax({
        url:'../../../../gescompta-api/ecriture/getForBalance.php',
        method:"POST",
        dataType: 'json',
        data:{debut : debut,
              fin : fin
             },
        success : function(data) {
            if (data == "NULL") {
                infoListeVide("Aucun enregistrement à afficher.");
            } else {
                // Show full page LoadingOverlay
                $.LoadingOverlay("show");

                // Hide it after 3 seconds
                setTimeout(function(){
                    $.LoadingOverlay("hide");
            	   affichageBal(data);
                }, 3000);
            }
        }
    });
}

var affichageBal = function (jsonData) {

	var dateDeb = $dateInf.val().split('-').reverse().join('/');
    var dateF = $dateSup.val().split('-').reverse().join('/');

	$tabBal.find('caption').html(`<h4>BALANCE - <strong>${dateDeb}</strong> AU <strong>${dateF}</strong></h4>`);

	$bodyBal.html('');
	
    var totalDebit = 0;
    var totalCredit = 0;
    var totalDebitSolde = 0;
    var totalCreditSolde = 0;
    
	$.each(jsonData, function(index,d){
		
		$bodyBal.append($(`		
		   	<tr>			
	            <td><center>${d.compte}</center></td>
	            <td><center>${d.debitTotal}</center></td>
				<td><center>${d.creditTotal}</center></td>
				<td><center>${d.debitSolde}</center></td>
				<td><center>${d.creditSolde}</center></td>		     												
		  	</tr>	
		`))
			
		//Calcul des totaux
		if (d.debitTotal != '') {
 			totalDebit += parseInt(d.debitTotal);
 		}

 		if (d.creditTotal != '') {
 			totalCredit += parseInt(d.creditTotal);
 		}

 		if (d.debitSolde != '') {
 			totalDebitSolde += parseInt(d.debitSolde);
 		}

 		if (d.creditSolde != '') {
 			totalCreditSolde += parseInt(d.creditSolde);
 		}			

    });

	//Ajout de la ligne des totaux
	$bodyBal.append($(`
			<tr style="font-weight : bold; font-size : 20px; border-width : 2px;">
				<td><center>Totaux</center></td>
				<td><center>${totalDebit}</center></td>
				<td><center>${totalCredit}</center></td>
				<td><center>${totalDebitSolde}</center></td>
				<td><center>${totalCreditSolde}</center></td>
			</tr>
	`));
}

$('#btnImprimerBal').on('click', function(event) {
	$('#tabBal').print({
		// Use Global styles
		globalStyles : true,
		
		// Add this on top
		append : "ITLCompta<br/>",

		// Add this at bottom
		prepend : "<br/>228itlabo.com"
	});
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