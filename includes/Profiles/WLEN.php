<?php
    include_once 'includes/subjectTableFunctions.php';
    include_once 'includes/profileData.php';

    //Funktion siehe ER.php
    function loadFHSSubjectChooser(){
        global $EAFWLEN;
        global $PFWLEN;
        global $FWLEN;
        global $LANGUAGES;
        $LANGUAGES = array();
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        loadEAs($EAFWLEN);
        $PFs = loadPFs($PFWLEN);
        $WFs = loadWFs($FWLEN);
        $table = getHTMLObject("table", array(), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        global $EAFWLEN;
        global $APFWLEN;
        global $P5WLEN;
        global $IVFWLEN;
        global $IIFWL;
        global $NAFWLEN;
        global $NAWLEN;
        global $WFWLEN;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEASubjects($EAFWLEN);
        $PSubjects = loadPSubjects($APFWLEN, $P5WLEN);
        $Subjects = loadSubjects($IVFWLEN, "IVF", 4);
        $SubjectsII = loadSubjects($IIFWL, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFWLEN, $NAWLEN);
        $WSubjects = loadWSubjects($WFWLEN);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi . $WSubjects);
    }
?>