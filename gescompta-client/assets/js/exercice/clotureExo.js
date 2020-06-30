$(document).on('click','.cloturer',function (event) {
	var id = $(this).attr('id');
	var messageEtat = 'Voulez-vous clôturer cet exercice ?';
	var action = "close";

	confirmCloture(messageEtat, id, action, $(this));

});

var confirmCloture = function (message, id, action, $btn) {
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
					url:'../../../../gescompta-api/exercice/cloture.php',
					method:"POST",
					data:{id : id, action : action},
					dataType : "json",
					success : function(data) {

						tableExo.ajax.reload();
						
						var changeText = "Fermé";
						var msg = 'Exercice clôturé avec succès.';

						infoCloture(msg,$btn,changeText);
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

var infoCloture = function (msg,$btn,newText) {

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
	            	$btn.attr('disabled','disabled');
	                $(this).dialog("close");
	                $("#dialog-confirm").remove();
	            }
        }
    });
}