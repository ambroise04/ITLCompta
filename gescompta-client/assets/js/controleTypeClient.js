$('#comboTypeClient').on('change', function(event) {
	if ($('#comboTypeClient option:selected').text() == 'morale') {
		$('#physique').fadeOut(1000, function() {
			$('#morale').show();
		});	
	} else {
		$('#morale').fadeOut(1000, function() {
			$('#physique').show();
		});
	}
});

$(document).ready(function($) {
	$('#myModal').on('open', function(event) {
		alert('OUI');
		$('#comboTypeClient2').on('change', function(event) {
			if ($('#comboTypeClient2 option:selected').text() == 'morale') {
				$('#physique2').fadeOut(1000, function() {
					$('#morale2').show();
				});	
			} else {
				$('#morale2').fadeOut(1000, function() {
					$('#physique2').show();
				});
			}
		});	
	});
});

