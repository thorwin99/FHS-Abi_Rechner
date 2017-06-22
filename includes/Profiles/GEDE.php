<?php
    include_once 'includes/subjectTableFunctions.php';

    //Funktion siehe ER.php
    function loadFHSSubjectChooser(){
        global $EAFGEDE;
        global $PFGESDE;
        global $FGESDE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFGEDE);
        $PFs = loadPFs($PFGESDE);
        $WFs = loadWFs($FGESDE);
        $table = getHTMLObject("table", array(), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        global $EAFGEDE;
        global $APFGEDE;
        global $P5Array;
        global $IVFGEDE;
        global $IIFGE;
        global $NAFGE;
        global $NAGE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFGEDE, $APFGEDE, $P5Array);
        $Subjects = loadSubjects($IVFGEDE, "IVF", 4);
        $SubjectsII = loadSubjects($IIFGE, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFGE, $NAGE);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi);
    }
?>