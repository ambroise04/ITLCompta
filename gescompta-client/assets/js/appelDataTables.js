//Client-Personnes physiques
var tableClientP = $("#clientPhysique").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/client/listeClientP.php",
        method : "POST"
    },

});

//Client-Personnes morales
var tableClientM = $("#clientMoral").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/client/listeClientM.php",
        method : "POST"
    },

});

//Table liste des utilisateurs
var tableUser = $("#userTable").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/users/users.php",
        method : "POST"
    },
});


//Table journal
var tableJournal = $("#tableJournal").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/journal/journalEnCours.php",
        method : "POST",
    }
});


//Table de tous les journaux
var allJournal = $("#allJournal").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/journal/allJournal.php",
        method : "POST",
    }
});

//Table de tous les projets
var tableProjet = $("#tableProjet").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/projet/liste.php",
        method : "POST",
    }
});


//Table des fournisseurs
var tableFrs = $("#tableFrs").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/fournisseur/listetable.php",
        method : "POST",
    }
});

//Table des exercices
var tableExo = $("#tableExo").DataTable({

    "language": {
        "url": "../assets/datatable/french.json"
    },

    "ajax" : {
        url : "../../gescompta-api/exercice/listeExo.php",
        method : "POST",
    }
});
