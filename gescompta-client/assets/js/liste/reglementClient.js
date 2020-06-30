const $nomClient = $('#nomClt');
const $comboProjet = $('#listeDesProjets');
const $nbreProj = $('#nbreProj');
const $btnListeReg = $('#btnListeReg');
const $coutProjet = $('#coutProj')

$nomClient.on('keyup', function() { 
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
                    remplirComboProjet(data);
                }
            }
        });

    } else{
        $comboProjet.html('');
        $nbreProj.val('0');
    }
    
});

var remplirComboProjet = function (jsonData) {
    var options = "";
    var nbreProj = 0;
    $.each(jsonData,function(index,d){
        options += '<option value="' + d.idProjet + '">' + d.libelle + '</option>';
        idClient = d.idClient;
        nbreProj++;
    })

    $comboProjet.html(options);

    $nbreProj.val(nbreProj);
}


$btnListeReg.on('click', function(event) {
	if ($nbreProj.val() != '0' && $nbreProj.val() != '') {
		traitement();
	}
});


var traitement = function () {
	var id = $('#listeDesProjets option:selected').val();
    var nom = $('#listeDesProjets option:selected').text();

	$.ajax({
        url:'../../../../gescompta-api/reglement/findRegByProjet.php',
        method:"POST",
        dataType: 'json',
        data:{projet : id},
        success : function(data) {
            if (data == "NULL") {
                infoVide("Aucun règlement n'a été enregistré pour ce projet");
            } else {
                // Show full page LoadingOverlay
                $.LoadingOverlay("show");

                // Hide it after 3 seconds
                setTimeout(function(){
                    $.LoadingOverlay("hide");

                    $.ajax({
                        url:'../../../../gescompta-api/projet/getMontantProjet.php',
                        method:"POST",
                        /*dataType: 'json',*/
                        data:{projet : nom},
                        success : function(data) {
                            if (data == "NULL") {
                                alert(data)
                                $coutProjet.val('Non trouvé');
                            } else {
                                $coutProjet.val(data + '  F CFA');
                            }
                        }
                    });
            	   affichage(data);
                }, 3000);
            }
        }
    });
}

var affichage = function (jsonData) {
	
	$('#tabListeRegClt').find('caption').html('<h4>LISTE DES REGLEMENTS DE <strong>' + $nomClient.val() + '</strong> - PROJET <strong>' + $('#listeDesProjets option:selected').text() + '</strong></h4>');

	$('#table-body').html('');
	
	$.each(jsonData, function(index,d){
		var ligne = $('<tr></tr>');

		ligne.append($('<td><center>' + d.date + '</center></td>'));
		ligne.append($('<td><center>' + d.montant + '</center></td>'));
		ligne.append($('<td><center>' + d.restant + '</center></td>'));
		ligne.append($('<td><center>' + d.solde + '</center></td>'));
        
    	$('#table-body').append(ligne);
    });

}

var infoVide = function (msg) {

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



$('#btnImprimerReg').on('click', function(event) {
    $.print('#tabListeRegClt');
});


