<?php
    include_once 'includes/subjectTableFunctions.php';
    include_once 'includes/profileData.php';

    //Funktion siehe ER.php
    function loadFHSSubjectChooser(){
        global $EAFWLDE;
        global $PFWLDE;
        global $FWLDE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFWLDE);
        $PFs = loadPFs($PFWLDE);
        $WFs = loadWFs($FWLDE);
        $table = getHTMLObject("table", array(), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        global $EAFWLDE;
        global $APFWLDE;
        global $P5WLDE;
        global $IVFWLDE;
        global $IIFWL;
        global $NAFWLDE;
        global $NAWLDE;
        global $WFWLDE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEASubjects($EAFWLDE);
        $PSubjects = loadPSubjects($APFWLDE, $P5WLDE);
        $Subjects = loadSubjects($IVFWLDE, "IVF", 4);
        $SubjectsII = loadSubjects($IIFWL, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFWLDE, $NAWLDE);
        $WSubjects = loadWSubjects($WFWLDE);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi . $WSubjects);
    }
?>