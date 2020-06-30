const $userForm = $('#formUser');
const $submitBtn = $('#btnSoumUser');
 var testOk = false;

var verify = function ($inputs) {
 
    $inputs.each(function (key, input) {
        $(input).on('focusout', function (event) {
            if ($(input).val().length < input.minLength) {
                // Pas correct -> afficher l'erreur
                $(input).parent().find('p').removeClass('hidden');
            } else {
                // Correct -> cacher l'erreur
                $(input).parent().find('p').addClass('hidden');
            }
        });
 
        $(input).on('keyup', function (event) {
            if (!($(input).val().length < input.minLength)) {
                // Correct -> cacher l'erreur
                $(input).parent().find('p').addClass('hidden');
                $(input).attr('valid', 'true');
            } else $(input).attr('valid', 'false');
 
 
            if ($('[valid=true]').length === $inputs.length) {
                allowSubmit();
            } else {
                preventSubmit()
            }
        });
    });
};



$(document).ready(function (event) {
    // Au chargement de la page
    saveMinLengths($userForm);
});


var saveMinLengths = function ($jqForm) {
    const $inputs = $jqForm.find('input[required]');
 
    // Vérifier et watch à chaque changement
    verify($inputs);
};


// Requête AJAX
var envoiAjax = function () { 

    $submitBtn.click(function(event) { 
        
    //Lancement d'AJAX par la méthode post
    var nom = $('#nomUser').val();
    var prenom = $('#prenomUser').val();
    var login = $('#loginUser').val();
    var passe = $('#passeUser').val();
    var email = $('#emailUser').val();
    var image = $('#photoUser').val();
    var typeUser = '';
    if ($('#comboTypeUser option:selected').val() == "1") {
    	typeUser = 0
    } else {
    	typeUser = 1
    }
    
    $.ajax({
		url:'../../../../gescompta-api/users/addUser.php',
		method:"POST",
		data:{nom : nom, 
		   prenom : prenom,
		   login : login,
		   passe : passe,
		   email : email,
		   image : image,
		   typeUser : typeUser
		},
		dataType : "json",
		success : function(data) {
			
			tableUser.ajax.reload();
			
			var msg = 'Utilisateur ajouté 	avec succès';	
			
			info(msg);
		} 
	});
            
                   
    });            
};

// Le formulaire ne réagit pas !
var preventSubmit = function () {
    // Une façon de griser
    $submitBtn.css({
        'opacity': '0.5',
        'cursor': 'default',
        'pointer-events': 'none'
    });
    
    testOk = false;

    $userForm.submit(function (event) {
        event.preventDefault();
    });
};
 
// Le formulaire réagit ici !
var allowSubmit = function () {
    // Rendre le bouton accessible
    $submitBtn.css({
        'opacity': '1',
        'cursor': 'pointer',
        'pointer-events': 'initial'
    });
    
    testOk = true;

    $userForm.submit(function (event) {
        event.preventDefault();
    });

    //Appel ajax
    envoiAjax();
};

var infoDelete = function (msg) {

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