const $target = $('#addSection');
const $targetListe = $('#listeComplete');
const $targetEncours = $('#listeJ');

$('.newJournal').on('click', function(event) {
    if ($target.offset()) {
     /* le sélecteur $(html, body) permet de corriger un bug sur chrome 
     et safari (webkit) */
      $('html, body')
     // on arrête toutes les animations en cours 
     .stop()
     /* on fait maintenant l'animation vers le haut (scrollTop) vers 
      notre ancre target */
     .animate({scrollTop: $target.offset().top-80}, 1000 );
    }
})


$('.tousJournaux').on('click', function(event) {
    if ($targetListe.offset()) {
     /* le sélecteur $(html, body) permet de corriger un bug sur chrome 
     et safari (webkit) */
      $('html, body')
     // on arrête toutes les animations en cours 
     .stop()
     /* on fait maintenant l'animation vers le haut (scrollTop) vers 
      notre ancre target */
     .animate({scrollTop: $targetListe.offset().top+50}, 1000 );
    }
})


$('.haut').on('click', function(event) {
    if ($targetEncours.offset()) {
     /* le sélecteur $(html, body) permet de corriger un bug sur chrome 
     et safari (webkit) */
      $('html, body')
     // on arrête toutes les animations en cours 
     .stop()
     /* on fait maintenant l'animation vers le haut (scrollTop) vers 
      notre ancre target */
     .animate({scrollTop: $targetEncours.offset().top-200}, 1000 );
    }
})
