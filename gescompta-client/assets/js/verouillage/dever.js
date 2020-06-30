const $btnDever = $('#btnDeverrouiller');
const $password = $('#passeDever');
const $modal = $('#myModal');

var adresse_prec = window.location.href.split('?')[1];

$.ajax({
	url:'../../../../gescompta-api/session/getConnected.php',
	method:"POST",
	dataType : "json",
	success : function(data) {
		if (data != "NULL") {
			$btnDever.on('click', function() {

				var passBase = data.passe;
				var passSaisi = $().crypt({method:"sha1",source:$password.val()});

				if (passBase == passSaisi) {
					// Show full page LoadingOverlay
					$.LoadingOverlay("show");
					// Hide it after 3 seconds
					$password.val('');
					$modal.modal('hide');
					setTimeout(function(){
					    $.LoadingOverlay("hide");
						//Redirection vers la page précédente
						window.location.href = adresse_prec;	
					}, 3000);
					
				} else {
					$password.val('');
					$modal.modal('hide');
					flatError('Mot de passe incorrect. Veuillez ressaisir votre mot de passe !')
				}
			});
		} else {
			// Show full page LoadingOverlay
			$.LoadingOverlay("show");

			// Hide it after 3 seconds
			setTimeout(function(){
			    $.LoadingOverlay("hide");
				//Redirection vers la page de connexion
				window.location.href = "../../../index.php";
			}, 3000);
		}
	} 
});

var flatError = function (msg) {
	displayNotification('error', msg, 3000);
}

var errorInfo = function (msg) {

    $('body').append('<div id="dialog-confirm" title="Erreur"');

    $("#dialog-confirm").html(msg);
    
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:160,
        width:500,
        autoOpen: true,
        modal: true,
        buttons: {
                "Ok": function() {
                    //Fermeture et suppression de la boîte de dialogue
                    $(this).dialog("close");
                    $("#dialog-confirm").remove();
                }
        }
    });
}