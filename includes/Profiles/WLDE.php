<?php
    include_once 'includes/subjectTableFunctions.php';

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
        global $P5Array;
        global $IVFWLDE;
        global $IIFWL;
        global $NAFWL;
        global $NAWL;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFWLDE, $APFWLDE, $P5Array);
        $Subjects = loadSubjects($IVFWLDE, "IVF", 4);
        $SubjectsII = loadSubjects($IIFWL, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFWL, $NAWL);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi);
    }
?>