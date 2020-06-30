const $bilanGlobal = $('#rowBilanGlobal');
const $bilanPeriod = $('#rowBilanPeriod');
const $legendeCharge = $('#legGain');
const $legendeGain = $('#legReg');
const $comment = $('#paraComment');
const $resultat = $('#result');

const $legendeChargePer = $('#legGainPer');
const $legendeGainPer = $('#legRegPer');
const $commentPer = $('#paraCommentPer');
const $resultatPer = $('#resultPer');

const $btnImprimerBilan = $('#btnImprimerBilan');

const $btnAfficheBil = $('#btnBilan');
const $dateDebutBil = $('#dateDebutBil');
const $dateFinBil = $('#dateFinBil');

const $bilanPer = $('#bilanPer');
const $bilanGlo = $('#bilanGlo');
const $bilanTitle = $('#bilanTitle');

var toPrint = 0;


$('input:radio[name="bilan"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'global') {
            $bilanGlobal.removeClass('hidden');
            $bilanPeriod.addClass('hidden');

            toPrint = 1;
			
			$.ajax({
				url:'../../../../gescompta-api/bilan/getTotauxChargeGain.php',
				method:"POST",
				dataType : "json",
				success : function(data) {
					var charge = data.charge;
					var gain = data.reglement;
					var pourcentageCharge = ((parseInt(charge) * 100) / (parseInt(charge)+parseInt(gain)));
					var pourcentageGain = ((parseInt(gain) * 100) / (parseInt(charge)+parseInt(gain)));

					// Show full page LoadingOverlay
	                $.LoadingOverlay("show");

	                // Hide it after 3 seconds
	                setTimeout(function(){

	                    $.LoadingOverlay("hide");

						$legendeCharge.html('Gain : ' + gain + ' F CFA');
						$legendeGain.html('Dépense : ' + charge + ' F CFA');

						
						if (parseInt(charge) < parseInt(gain)) {
							$comment.html('POSITIF');
							$comment.css('color', 'green');
							$resultat.html(parseInt(gain) - parseInt(charge) + ' F CFA');
							$resultat.css('color', 'green');
						}else if (parseInt(charge) > parseInt(gain)) {
							$comment.html('NEGATIF');
							$comment.css('color', 'red');
							$resultat.html(parseInt(charge) - parseInt(gain) + ' F CFA');
							$resultat.css('color', 'red');
						} else {
							$comment.html('NUL');
							$comment.css('color', '#424a5d');
							$resultat.html('0' + ' F CFA');
							$resultat.css('color', '#424a5d');
						}

						var statData = [
						        {
						            value: pourcentageCharge,
						            color:"#424a5d"
						        },
						        {
						            value : pourcentageGain,
						            color : "#0abad6"
						        }
						    ];

						new Chart(document.getElementById('statBilan').getContext("2d")).Pie(statData);
						$btnImprimerBilan.removeClass('hidden');

	                }, 2000);
				} 
			});
        
        } else {

            $bilanPeriod.removeClass('hidden');
            $bilanGlobal.addClass('hidden');
            $legendeCharge.html('');
			$legendeGain.html('');

			toPrint = 2;

            $btnImprimerBilan.addClass('hidden');

			$btnAfficheBil.on('click', function() {
				
			    if ($dateDebutBil.val() != '' && $dateFinBil.val() != '') {

			        if ($dateDebutBil.val() > $dateFinBil.val()) {
			            flatError('Veuillez vérifier la date de fin. Elle est inférieure à la date de début.');
			        } else {
			            
			            $.ajax({
							url:'../../../../gescompta-api/bilan/getTotauxChargeGainPer.php',
							method:"POST",
							data : {dateDebut : $dateDebutBil.val(), dateFin : $dateFinBil.val()},
							dataType : "json",
							success : function(data) {
								$bilanPer.removeClass('hidden');
								afficheBilanPer(data)
							}
						});

			        }

			    } else {

			        flatError('Veuillez renseigner les deux dates!');
			    }
			});
			
        }
});



var afficheBilanPer = function (data) {

	var charge = data.charge;
	var gain = data.reglement;
	var pourcentageCharge = ((parseInt(charge) * 100) / (parseInt(charge)+parseInt(gain)));
	var pourcentageGain = ((parseInt(gain) * 100) / (parseInt(charge)+parseInt(gain)));

	// Show full page LoadingOverlay
    $.LoadingOverlay("show");

    // Hide it after 3 seconds
    setTimeout(function(){

        $.LoadingOverlay("hide");

		$legendeChargePer.html('Gain : ' + gain + ' F CFA');
		$legendeGainPer.html('Dépense : ' + charge + ' F CFA');

		$bilanTitle.html('Bilan de la période du ' + $dateDebutBil.val().split('-').reverse().join('/') + ' au ' + $dateFinBil.val().split('-').reverse().join('/') + ' : RAPPORT GAIN / DEPENSE')		
		if (parseInt(charge) < parseInt(gain)) {
			$commentPer.html('POSITIF');
			$commentPer.css('color', 'green');
			$resultatPer.html(parseInt(gain) - parseInt(charge) + ' F CFA');
			$resultatPer.css('color', 'green');
		}else if (parseInt(charge) > parseInt(gain)) {
			$commentPer.html('NEGATIF');
			$commentPer.css('color', 'red');
			$resultatPer.html(parseInt(charge) - parseInt(gain) + ' F CFA');
			$resultatPer.css('color', 'red');
		} else {
			$commentPer.html('NUL');
			$commentPer.css('color', '#424a5d');
			$resultatPer.html('0' + ' F CFA');
			$resultatPer.css('color', '#424a5d');
		}

		var statData = [
		        {
		            value: pourcentageCharge,
		            color:"#424a5d"
		        },
		        {
		            value : pourcentageGain,
		            color : "#0abad6"
		        }
		    ];

		new Chart(document.getElementById('statBilanPer').getContext("2d")).Pie(statData);
		$btnImprimerBilan.removeClass('hidden');

    }, 3000);
}


$btnImprimerBilan.on('click', function() {
	if (toPrint = 1) {
    	$.print('#bilanGlo');
	} else if (toPrint = 2) {
		$.print('#bilanPer');
	} 
});


$(document).ready(function() {
	$bilanGlobal.addClass('hidden');
	$bilanPeriod.addClass('hidden');

	$bilanPer.addClass('hidden');

	$btnImprimerBilan.addClass('hidden');
});



var flatError = function (msg) {
	displayNotification('error', msg, 3000);
}

var flatInfo = function (msg) {
	displayNotification('info', msg, 3000);
}

var flatSuccess = function (msg) {
	displayNotification('success', msg, 3000);
}

var flatWarning = function (msg) {
	displayNotification('warning', msg, 3000);
}