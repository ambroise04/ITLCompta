$(document).on('click','.cloturer',function (event) {
	var id = $(this).attr('id');
	var messageEtat = 'Voulez-vous clôturer ce journal ?';
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
					url:'../../../../gescompta-api/journal/cloture.php',
					method:"POST",
					data:{id : id, action : action},
					dataType : "json",
					success : function(data) {
						// Show full page LoadingOverlay
						$.LoadingOverlay("show");

						// Hide it after 3 seconds
						setTimeout(function(){
						    $.LoadingOverlay("hide");
							allJournal.ajax.reload();
							tableJournal.ajax.reload();
							
							var changeText = "Fermé";
							var msg = 'Journal clôturé avec succès.';

							infoCloture(msg,$btn,changeText);
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