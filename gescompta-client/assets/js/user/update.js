const $btnValid = $('#btnSoumUser');
const $formUser = $('#formUser');
var $title = $('#title-new-user');
var tampon = $title.html();
var modifier = false;
var idUpdate = '';

$(document).on('click','.modifier',function (event) {
	$('#passeUser').fadeIn();
	$('#btnSoumUser').attr('edit','true');
	var id = $(this).attr('id');
	update(id);
	idUpdate = id;
	sendUpdate();
	//confirm(message,action,id);
});

var sendUpdate = function () {

	$btnValid.click(function(e) {
		//Bloquer action par défaut
		e.preventDefault();

		if ($(this).attr('edit')) {

			//Test pour vérifier s'il s'agit d'une modification
			var message = 'Voulez-vous soumettre ces modifications ?';
			if(modifier){
				confirm(message, idUpdate);
			}
		}

	});
}

var confirm = function (message, id) {
	$('body').append('<div id="dialog-confirm" title="Confirmation"></div>');

	$("#dialog-confirm").html(message);
	
	$( "#dialog-confirm" ).dialog({
        resizable: false,
        height:160,
        width:500,
        autoOpen: true,
        modal: true,
        buttons: {
            "Oui": function() {
            	var action = 'edit';
            	var nom = $('#nomUser').val();
            	var prenom = $('#prenomUser').val();
            	var login = $('#loginUser').val();
            	//var password = $('#passeUser').val();
            	var email = $('#emailUser').val();

            	if($('#comboTypeUser option:selected').text() == 'administrateur'){
            		var idTypeUser = 1
            	} else {
            		var idTypeUser = 0
            	}

            	var image = $('#photoUser').val();

            	$.ajax({
					url:'../../../../gescompta-api/users/updateUser.php',
					method:"POST",
					data:{id : id, 
						  action : action,
						  nom : nom,
						  prenom : prenom,
						  login : login,
						  //password : password,
						  email : email,
						  idTypeUser : idTypeUser,
						  image : image
						},
					dataType : "json",
					success : function(data) {
						// Show full page LoadingOverlay
						$.LoadingOverlay("show");

						// Hide it after 3 seconds
						setTimeout(function(){
						    $.LoadingOverlay("hide");
							tableUser.ajax.reload();
							var msg = 'Modification effectuée avec succès';					
							info(msg);
						}, 3000);
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

var update = function (id) {


	$title.html('MODIFICATION - UTILISATEUR');

	modifier = true;

	$.ajax({
		url:'../../../../gescompta-api/users/updateUser.php',
		method:"POST",
		data:{id : id},
		dataType : "json",
		success : function(data) {
			remplirChamps(data);
		} 
    });
}

var info = function (msg) {

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
	            	raz($formUser);
	            	$target = $('#top-user');
					goToTarget($target);
					$target = $('#ajout');
					$('#passeUser').fadeOut();
	                $(this).dialog("close");
	                $("#dialog-confirm").remove();
	            }
        }
        });
}

var $target = $('#ajout');

var goToTarget = function () {

    if ($target.offset()) {
     /* le sélecteur $(html, body) permet de corriger un bug sur chrome 
     et safari (webkit) */
      $('html, body')
     // on arrête toutes les animations en cours 
     .stop()
     /* on fait maintenant l'animation vers le haut (scrollTop) vers 
      notre ancre target */
     .animate({scrollTop: $target.offset().top}, 1000 );
    }
}


var remplirChamps = function (jsonData) {

	
	$('#nomUser').val(jsonData.nom);
	$('#prenomUser').val(jsonData.prenom);
	$('#emailUser').val(jsonData.email);
	$('#loginUser').val(jsonData.login);
	//$('#passeUser').val(jsonData.passe);
	if (jsonData.type == 1) {
		$('#comboTypeUser').val('1')
	} else if (jsonData.type == 2){
		$('#comboTypeUser').val('2')
	} else {
		$('#comboTypeUser').val('3')
	}

	/*$('#photoUser').val(jsonData.photo);*/

	//Scroller au formulaire de modification
	goToTarget();
}

//Fonction pour raser les champs

var raz = function ($formulaire) {
	$formInputs = $formulaire.find('input');
	$formSelect = $formulaire.find('select');
	
	$formInputs.each(function (key, input) {
		$(input).val('');
	});

	$formSelect.each(function (key, select) {
		$(select).val('1');
	});

	$title.html(tampon);
	$btnValid.removeAttr('edit');
}