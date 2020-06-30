

$(document).ready(function(){
    // au clic sur un lien
    $('a[data-anchor]').on('click', function(evt){
         evt.preventDefault();
         // bloquer le comportement par défaut: on ne rechargera pas la page
         // enregistre la valeur de l'attribut  href dans la variable target
        var target = $(this).attr('data-anchor');

        if ($(target).offset()) {
         /* le sélecteur $(html, body) permet de corriger un bug sur chrome 
         et safari (webkit) */
          $('html, body')
         // on arrête toutes les animations en cours 
         .stop()
         /* on fait maintenant l'animation vers le haut (scrollTop) vers 
          notre ancre target */
         .animate({scrollTop: $(target).offset().top}, 1000 );
         return false;
        } else {
            window.location.href = $(this).attr('href') + target;
            return true;
        }
  });
});

