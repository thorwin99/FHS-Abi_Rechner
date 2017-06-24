<?php
    include_once 'includes/subjectTableFunctions.php';
    include_once 'includes/profileData.php';

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
        global $P5GEEN;
        global $IVFGEEN;
        global $IIFGE;
        global $NAFGEEN;
        global $NAGEEN;
        global $WFGEEN;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFGEEN, $APFGEEN, $P5GEEN);
        $Subjects = loadSubjects($IVFGEEN, "IVF", 4);
        $SubjectsII = loadSubjects($IIFGE, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFGEEN, $NAGEEN);
        $WSubjects = loadWSubjects($WFGEEN);
        
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi . $WSubjects);
    }
?>