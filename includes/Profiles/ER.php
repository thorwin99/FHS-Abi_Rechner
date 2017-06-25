<?php
    include_once 'includes/subjectTableFunctions.php';
    include_once 'includes/profileData.php';

    /*Funktion zum ausgeben der Fachtabelle zum Auswählen der Fächer
    */
    function loadFHSSubjectChooser(){
        /*Globale Variablen
        Siehe ProfileData.php
        */
        global $EAFER;
        global $PFER;
        global $FER;
        global $LANGUAGES;
        
        //Fügt die 2. Fremdsprache zu der anderen hinzu
        array_push($LANGUAGES, $_POST['seclanguage']);
        
        //Lädt die e.A. Fächer. Diese müssen nicht ausgewählt werden, weshalb auch keine Variable zugewiesen wird. Die werte werden direkt versteckt ausgegeben.
        loadEAs($EAFER);
        
        //Lädt die Tabellenzeile der Pflichtfächer, also alle Fächer die vorgegeben sind.
        $PFs = loadPFs($PFER);
        
        //Lädt die Tabellenzeile der Wahlfächer
        $WFs = loadWFs($FER);
        
        //Erstellt die Tabelle und gibt sie aus.
        $table = getHTMLObject("table", array("class" => "chooseSubjTable"), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        /*Globale Werte
        Siehe ProfileData.php
        */
        global $EAFER;
        global $APFER;
        global $P5ER;
        global $IVFER;
        global $IIFER;
        global $NAFER;
        global $NAER;
        global $WFER;
        global $LANGUAGES;
        
        //Fügt die 2. Fremdsprache zu der anderen hinzu
        array_push($LANGUAGES, $_POST['seclanguage']);
        
        //Lädt die Tabellenzeilen der Fachauswahl
        loadEASubjects($EAFER);
        $PSubjects = loadPSubjects($APFER, $P5ER);
        $Subjects = loadSubjects($IVFER, "IVF", 4);
        $SubjectsII = loadSubjects($IIFER, "IIF", 2);
        $NaWi = loadNaWiSubjects($NAFER, $NAER);
        $WSubjects = loadWSubjects($WFER);
        loadSecLanguage($_POST['seclanguage']);
        
        //Gibt die Tabelle aus.
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi . $WSubjects);
    }
?>