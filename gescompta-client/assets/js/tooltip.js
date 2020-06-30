$(".tooltip").on('mouseenter',function(event) {
	infobulle(event,250,50,'#424a5d','Indication','Cliquez pour sélectionner un journal');
});

$(".tooltip").on('mouseout',function(event) {
	hideTooltip();
});


var infobulle = function (event,larg,haut,coul,titre,baratin) {
	var x=event.clientX;
	var y=event.clientY;

	document.getElementsByName("tooltip").style.width =larg+'px';
	document.getElementsByName("tooltip").style.height =haut+'px'
	document.getElementsByName("tooltip").style.backgroundColor = coul;

	if (titre !='') {
		document.getElementsByName("titretooltip").innerHTML=titre
	}

	if (baratin !='') {
		document.getElementsByName("corpstooltip").innerHTML=baratin}
		document.getElementsByName("tooltip").style.left =(x+10)+'px';
		document.getElementsByName("tooltip").style.top =(y-haut -10)+'px';
		document.getElementsByName("tooltip").style.display ='block';
}

var hideTooltip = function() {
	document.getElementsByName("tooltip").style.display ='none';
}