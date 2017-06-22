<?php
    include_once 'includes/subjectTableFunctions.php';

    //Funktion siehe ER.php
    function loadFHSSubjectChooser(){
        global $EAFGEEN;
        global $PFGESEN;
        global $FGESEN;
        global $LANGUAGES;
        $LANGUAGES = array();
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFGEEN);
        $PFs = loadPFs($PFGESEN);
        $WFs = loadWFs($FGESEN);
        $table = getHTMLObject("table", array(), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        global $EAFGEEN;
        global $APFGEEN;
        global $P5Array;
        global $IVFGEEN;
        global $IIFGE;
        global $NAFGE;
        global $NAGE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFGEEN, $APFGEEN, $P5Array);
        $Subjects = loadSubjects($IVFGEEN, "IVF", 4);
        $SubjectsII = loadSubjects($IIFGE, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFGE, $NAGE);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi);
    }
?>