<?php
    include_once 'includes/subjectTableFunctions.php';
    include_once 'includes/profileData.php';

    //Funktion siehe ER.php
    function loadFHSSubjectChooser(){
        global $EAFTE;
        global $PFTE;
        global $FTE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFTE);
        $PFs = loadPFs($PFTE);
        $WFs = loadWFs($FTE);
        $table = getHTMLObject("table", array(), $PFs . $WFs);
        echo $table;
    }

    function loadAbiSubjectChooser(){
        global $EAFTE;
        global $APFTE;
        global $P5TE;
        global $IVFTE;
        global $IIFTE;
        global $NAFTE;
        global $NATE;
        global $WFTE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        $PSubjects = loadPSubjects($EAFTE, $APFTE, $P5TE);
        $Subjects = loadSubjects($IVFTE, "IVF", 4);
        $SubjectsII = loadSubjects($IIFTE, "IIF", 2);
        $NaWi = loadNaWiSubjectsTG($NAFTE, $NATE);
        $WSubjects = loadWSubjects($WFTE);
        loadSecLanguage($_POST['seclanguage']);
        
        echo getHTMLObject("table", array(), $PSubjects . $Subjects . $SubjectsII . $NaWi . $WSubjects);
    }

    function loadNaWiSubjectsTG($NAF, $NA){
        $FachTD = "";
        $CardTD = "";
        $CardText = "Wähle hier die 1. und 2. Naturwissenschaft aus.";
        if(sizeof($NAF) != 0){//1. Nawi
            foreach($NAF as $key => $Subject){
                if(gettype($Subject) == "array"){
                    $FachTD = $FachTD . getHTMLObject("h3", array(), "Naturwissenschaften");
                    $FachTD = $FachTD . getHTMLObject("h4", array(), "1. Naturwissenschaft");
                    $Dropdown = getDropdownList("subj[]", array("class" => $key . " INaWi"), $Subject);
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 4), "");
                    $FachTD = $FachTD . $Dropdown . $HiddenAmountField;
                }else{
                    $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 4), "");
                    echo $HiddenLabel . $HiddenAmountField;
                }
            }
        }
        if(sizeof($NA) != 0){//2. Nawi
            $table = "";
            foreach($NA as $key => $Subject){
                if(gettype($Subject) == "array"){
                    $FachTD = $FachTD . getHTMLObject("h4", array(), "2. Naturwissenschaft");
                    $Dropdown = getDropdownList("subj[]", array("class" => $key . " IINaWi"), $Subject);
                    $Label = getHTMLObject("td", array("class" => "subjectLabelDD"), $Dropdown);
                    $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "subjamount[]", "value" => 4, "class" => "NaWiCheckbox"), "");
                    $TdCheck = getHTMLObject("td", array(), $Checkbox);
                    $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
                }else{
                    $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                    $Label = getHTMLObject("td", array("class" => "subjectLabel"), $Subject . $HiddenLabel);
                    $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "subjamount[]", "value" => 4, "class" => "NaWiCheckbox"), "");
                    $TdCheck = getHTMLObject("td", array(), $Checkbox);
                    $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
                }
            }
            $FachTD = $FachTD . getHTMLObject("table", array(), $table);
        }
         if($FachTD != ""){//Wenn es überhaubt diese Tabellenspalte gibt, wird eine Hilfe cardview erstellt
            $CardTD = createCardView($CardText, array("Schließen" => "$(this).parent().parent().hide(500)"), "Naturwissenschaften");
        }
        return getHTMLObject("tr", array(), getHTMLObject("td", array(), $FachTD) . getHTMLObject("td", array(), $CardTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
?>