<?php
    include_once 'includes/subjectTableFunctions.php';

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
        global $P5Array;
        global $IVFWLEN;
        global $IIFWL;
        global $NAFWL;
        global $NAWL;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFWLEN, $APFWLEN, $P5Array);
        $Subjects = loadSubjects($IVFWLEN, "IVF", 4);
        $SubjectsII = loadSubjects($IIFWL, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFWL, $NAWL);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi);
    }
?>