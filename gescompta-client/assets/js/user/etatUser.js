$(document).on('click','.desactiver',function (event) {
	var id = $(this).attr('id');
	var messageEtat = '';
	var textBtn = $(this).text();
	var action = "";

	if(textBtn == "Désactiver"){

		action = "desactiver";
		messageEtat = 'Voulez-vous désactiver cet utilisateur ?';

	} else if(textBtn == "Activer"){

		action = "activer";
		messageEtat = 'Voulez-vous activer cet utilisateur ?';

	}

	confirmEtat(messageEtat, id, action, $(this));

});

var confirmEtat = function (message, id, action, $btn) {
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

            	$.ajax({
					url:'../../../../gescompta-api/users/etatUser.php',
					method:"POST",
					data:{id : id, action : action},
					dataType : "json",
					success : function(data) {
						
						tableUser.ajax.reload();
						
						var changeText = "";
						var msg = '';
						
						if (action == 'desactiver') {
							msg = 'Utilisateur désactivé avec succès'	
						} else {
							msg = 'Utilisateur activé avec succès'	
						}

						if($btn.text() == "Désactiver"){
							changeText = "Activer"
						} else {
							changeText = "Désactiver"
						}
						// Show full page LoadingOverlay
						$.LoadingOverlay("show");

						// Hide it after 3 seconds
						setTimeout(function(){
						    $.LoadingOverlay("hide");
							infoEtat(msg,$btn,changeText);
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

var infoEtat = function (msg,$btn,newText) {

	$('body').append('<div id="dialog-confirm" title="Infomation"></div>');

	$("#dialog-confirm").html(msg);
	
	$( "#dialog-confirm" ).dialog({
        resizable: false,
        height:160,
        width:500,
        autoOpen: true,
        modal: true,
        buttons: {
	            "Ok": function() {
	            	$btn.html(newText);
	                $(this).dialog("close");
	                $("#dialog-confirm").remove();
	            }
        }
    });
}