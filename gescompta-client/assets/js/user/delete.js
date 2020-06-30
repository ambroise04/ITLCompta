$(document).on('click','.supprimer',function (event) {
	var id = $(this).attr('id');
	
	var messageDelete = 'Voulez-vous supprimer cet utilisateur ?';

	confirmDelete(messageDelete, id);

});

var confirmDelete = function (message, id) {
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
					url:'../../../../gescompta-api/users/deleteUser.php',
					method:"POST",
					data:{id : id},
					dataType : "json",
					success : function(data) {
						// Show full page LoadingOverlay
						$.LoadingOverlay("show");

						// Hide it after 3 seconds
						setTimeout(function(){
						    $.LoadingOverlay("hide");
							tableUser.ajax.reload();

							var msg = 'Utilisateur supprimé avec succès';
							
							infoDelete(msg);
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