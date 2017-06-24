<?php
    require_once 'includes/htmlObjectFunctions.php';
    
    //Lädt die Tabelle aus den PHP dateien nach dem Ausgesuchtem Profil.
    switch($_POST['profil']){
        case "GE":
            //Auswahl des Profils nach der Profilsprache (Deutsch, Englisch)
            if($_POST['language'] == "DE"){
                include_once 'includes/Profiles/GEDE.php';
            }else{
                include_once 'includes/Profiles/GEEN.php';
            }
            break;
        case "ER":
                include_once 'includes/Profiles/ER.php';
            break;
        case "WL":
            //Auswahl des Profils nach der Profilsprache (Deutsch, Englisch)
            if($_POST['language'] == "DE"){
                include_once 'includes/Profiles/WLDE.php';
            }else{
                include_once 'includes/Profiles/WLEN.php';
            }
            break;
        case "TE":
                include_once 'includes/Profiles/TE.php';
            break;
    }
    if($_POST['absch'] == "Abitur"){
        //Gibt die Tabelle aufgrund des zufor ausgewähltem Profil aus
        loadAbiSubjectChooser();
    }else{
        //Gibt die Tabelle aufgrund des zufor ausgewähltem Profil aus
        loadFHSSubjectChooser();
    }
?>