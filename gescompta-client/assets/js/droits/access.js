const $menuUser = $('#menu-user');
const $menuExo = $('#menu-exercice');
const $connected = $('#connectedUser');
const $profil = $('#descUser');
const $logout = $('#deconnexion');
const $lienDever = $('#devLink');

//Enregistrement de l'adresse url pour le retour après le verrouillage
var addresse_url = window.location.href;

window.onload = function() {
	$.ajax({
		url:'../../../../gescompta-api/session/getConnected.php',
		method:"POST",
		dataType : "json",
		success : function(data) {
			if (data != "NULL") {
				if (data.type == 'Comptable') {

					$connected.html(' ' + data.prenom.split(' ')[0] + ' <span class="caret"></span>');
					$profil.html(data.type);

					$menuUser.remove();
					$menuExo.remove();

				} else if (data.type == 'Chef-comptable') {

					$connected.html(' ' + data.prenom.split(' ')[0] + ' <span class="caret"></span>');
					$profil.html(data.type);

					$menuUser.remove();

				} else if (data.type == 'Administrateur'){

					$connected.html(' ' + data.prenom.split(' ')[0]+ ' <span class="caret"></span>');
					$profil.html(data.type);

				}

				//Traitement déconnexion
				var id = data.id;
				$logout.on('click', function(event) {
					event.preventDefault();
					
					confirLogout('Se déconnecter ?', id);
				});


			} else {
				//Redirection vers la page de connexion
				window.location.href = "../index.php";
			}
		} 
	});
	
};

var confirLogout = function (message, id) {
    $('body').append('<div id="dialog-confirm" title="Confirmation" style="background-color: #0abad6"></div>');

    $("#dialog-confirm").html(message);
    
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:160,
        width:500,
        autoOpen: true,
        modal: true,
        buttons: {
            "Oui": function(){
                    
                    $.ajax({
						url : '../../../../gescompta-api/session/disconnect.php',
						method : "POST",
						data : {id : id},
						dataType : "json",
						success : function(data) {
							if (data = "OK") {
								// Show full page LoadingOverlay
								$.LoadingOverlay("show");

								// Hide it after 3 seconds
								setTimeout(function(){
								    $.LoadingOverlay("hide");
									window.location.href = "../index.php";
								}, 3000);
							}
						}
					});

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

/*$(document).ready(function() {
	addresse_url = window.location.href;	
});*/

$lienDever.on('click', function(event) {
	event.preventDefault();
	window.location.href = $(this).attr('href') + '?' + addresse_url;
});

