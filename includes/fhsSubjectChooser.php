<?php
    include_once 'includes/profileData.php';
    require_once 'includes/htmlObjectFunctions.php';
    
    switch($_POST['profil']){//Lädt die Tabelle aus den PHP dateien nach dem Ausgesuchtem Profil.
        case "GE":
            if($_POST['language'] == "DE"){
                include_once 'includes/Profiles/GEDE.php';
            }else{
                include_once 'includes/Profiles/GEDE.php';
            }
            break;
        case "ER":
                include_once 'includes/Profiles/GEDE.php';
            break;
        case "WL":
            if($_POST['languag'] == "DE"){
                include_once 'includes/Profiles/GEDE.php';
            }else{
                include_once 'includes/Profiles/GEDE.php';
            }
            break;
        case "TE":
                include_once 'includes/Profiles/GEDE.php';
            break;
    }
?>