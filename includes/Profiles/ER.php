<?php
    include_once 'includes/subjectTableFunctions.php';

    function loadFHSSubjectChooser(){
        global $EAFER;//Siehe ProfileData.php
        global $PFER;//Siehe ProfileData.php
        global $FER;//Siehe ProfileData.php
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFER);
        $PFs = loadPFs($PFER);
        $WFs = loadWFs($FER);
        $table = getHTMLObject("table", array("class" => "chooseSubjTable"), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        global $EAFER;
        global $APFER;
        global $P5Array;
        global $IVFER;
        global $IIFER;
        global $NAFER;
        global $NAER;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFER, $APFER, $P5Array);
        $Subjects = loadSubjects($IVFER, "IVF", 4);
        $SubjectsII = loadSubjects($IIFER, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFER, $NAER);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi);
    }
?>