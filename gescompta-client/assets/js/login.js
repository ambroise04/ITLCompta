const $loginForm = $('#formulaire');
const $login = $('#login');
const $passe = $('#passe');
const $submitBtn = $('#valider');
var testOk = false;
 
var verify = function ($inputs) {
    var allDone = 0;
 
    $inputs.each(function (key, input) {
        $(input).on('focusout', function (event) {

            if ($(input).val().length < input.minLength) {
                // Pas correct -> afficher l'erreur
                $(input).parent().find('p[check]').removeClass('hidden');
            } else {
                // Correct -> cacher l'erreur
                $(input).parent().find('p').addClass('hidden');
                //envoiAjax();
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
                envoiAjax();
            } else {
                preventSubmit()
            }
        });
    });
};
 
var constraintInput = function (input) {
    $(input).on('focusout', function (event) {
        if ($(input).val().length < input.minLength) {
            // Pas correct -> afficher l'erreur
            $(input).parent().find('p').removeClass('hidden');
        } else {
            // Correct -> cacher l'erreur
            $(input).parent().find('p').addClass('hidden');
        }
    });
 
    // Pour empêcher de modifier dans la console
    Object.freeze(input);
};
 
 
var saveMinLengths = function ($jqForm) {
    const $inputs = $jqForm.find('input[required]');
   
 
    // Vérifier et watch à chaque changement
    verify($inputs);
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

    $loginForm.submit(function (event) {
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

};

// Requête AJAX
var envoiAjax = function () {
    //if (testOk) {        
        $submitBtn.click(function(event) {
            event.preventDefault();
            //Lancement du loader
            showLoader();  
            
            //Arrêt du loader et lancement d'AJAX par la méthode post
            $('#paraImg').fadeOut(4000, function (argument) {
                var userLogin = $login.val();
                var userPasse = $passe.val();
                
                $.post('../../../gescompta-api/index.php', {login: userLogin,passe: userPasse}, function(data) {
                    actionReponseAjax(data);
                },"json");
                
            });             
        }); 
           
    //};
};

var actionReponseAjax = function ($data) {
    console.log($data);
    //Si tout s'est bien déroulé
    if ($data.response == "CORRECT") {

        //Redirection vers la page d'accueil
        //window.location.href = "accueil.php?user=" + $data.user + "&type=";
        $('#connectedUser').html("");
        $('#connectedUser').html($data.user);
        window.location.href = "accueil.php";
        //Le login saisi ne correspond à aucun utilisateur
    } else if ($data.response == "USER_NOT_FOUND" || $data.response == "WRONG_PASS") {

        $login.css('background-color', '#fedee0');
        $passe.css('background-color', '#fedee0');

        $("#parLoginError").removeClass('hidden');
        
        $login.focus(function () {
            $(this).css('background-color', '#ffffff');
            $passe.css('background-color', '#ffffff');
        })

        $passe.focus(function () {
            $(this).css('background-color', '#ffffff');
            $login.css('background-color', '#ffffff');
        })

        $("#parLoginError").fadeOut(5000);
    }
}
 

var showLoader = function (argument) {
    $('#paraImg').toggleClass('hidden');
}


$(document).ready(function (event) {
    // Au chargement de la page
    saveMinLengths($loginForm);
 
    // Interdir le click sur le bouton
    preventSubmit();
});