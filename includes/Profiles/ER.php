<?php
    function loadFHSSubjectChooser(){
        global $EAFER;//Siehe ProfileData.php
        global $PFER;//Siehe ProfileData.php
        global $FER;//Siehe ProfileData.php
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFER);
        loadPFs($PFER);
        loadWFs($FER);
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
        
        loadPSubjects($EAFER, $APFER);
        loadP5DropDown($P5Array);
        loadSubjects($IVFER, "IVF", 4);
        loadSubjects($IIFER, "IIF", 2);
        loadNaWiSubjects($NAFER, $NAER);
    }

    function loadPSubjects($EAF, $APF){
        $table = "";
        echo getHTMLObject("h3", array(), "Mündliche Prüfungen");
        foreach($EAF as $EASubject){
            $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "easubj[]", "value" => $EASubject), "");
            $Label = getHTMLObject("td", array("class" => "subjectLabel"), $EASubject . $HiddenLabel);
            $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "mdlPrf[" . $EASubject ."]", "value" => true), "");
            $TdCheck = getHTMLObject("td", array(), $Checkbox);
            $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
        }
        foreach($APF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("psubj[]", array("class" => $key . " APF"), $Subject);
                $Label = getHTMLObject("td", array("class" => "subjectLabelDD"), $Dropdown);
                $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "mdlPrf[" . $key . "]", "value" => true, "class" => $key . " APF"), "");
                $TdCheck = getHTMLObject("td", array(), $Checkbox);
                $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
            }else{
                $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "psubj[]", "value" => $Subject), "");
                $Label = getHTMLObject("td", array("class" => "subjectLabel"), $Subject . $HiddenLabel);
                $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "mdlPrf[" . $Subject ."]", "value" => true), "");
                $TdCheck = getHTMLObject("td", array(), $Checkbox);
                $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
            }
        }
        echo getHTMLObject("table", array(), $table);
    }
    function loadP5DropDown($P5Array){
        echo getHTMLObject("h3", array(), "5. Prüfungsfach (mündlich)");
        $Dropdown = getDropdownList("p5subj", array("class" => "p5subject"), $P5Array);
        echo $Dropdown;
    }
    function loadSubjects($FER, $type, $amount){
        foreach($FER as $key => $Subject){
            if(gettype($Subject) == "array"){
                echo getHTMLObject("h3", array(), $key);
                $Dropdown = getDropdownList("subj[]", array("class" => $key . " " . $type), $Subject);
                $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => $amount), "");
                echo $Dropdown . $HiddenAmountField;
            }else{
                $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => $amount), "");
                echo $HiddenLabel . $HiddenAmountField;
            }
        }
    }
    function loadNaWiSubjects($NAF, $NA){
        if(sizeof($NAF) != 0){
            foreach($NAF as $key => $Subject){
                if(gettype($Subject) == "array"){
                    echo getHTMLObject("h3", array(), "1. Naturwissenschaft");
                    $Dropdown = getDropdownList("subj[]", array("class" => $key . " INaWi"), $Subject);
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 4), "");
                    echo $Dropdown . $HiddenAmountField;
                }else{
                    $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 4), "");
                    echo $HiddenLabel . $HiddenAmountField;
                }
            }
        }
        if(sizeof($NA) != 0){
            foreach($NA as $key => $Subject){
                if(gettype($Subject) == "array"){
                    echo getHTMLObject("h3", array(), "2. Naturwissenschaft");
                    $Dropdown = getDropdownList("subj[]", array("class" => $key . " IINaWi"), $Subject);
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 2), "");
                    echo $Dropdown . $HiddenAmountField;
                }else{
                    $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 2), "");
                    echo $HiddenLabel . $HiddenAmountField;
                }
            }
        }
    }

    function loadEAs(array $EAF){//Lädt die e.A. Fächer als verstecktes Input feld.
        foreach($EAF as $Subject){
            echo getHTMLObject("input", array("name" => "easubj[]", "value" => $Subject, "type" => "hidden"), "");
        }
    }
    /*Lädt die vorgegeben Fächer
    Bei einem Array wird eine Dropdownliste mit der Klasse des Keys ind einer ID FPF, für JS ausgegeben
    */
    function loadPFs(array $PF){
        foreach($PF as $key => $Subject){
            if(gettype($Subject) == "array"){//Wenn das momentane PF ein array ist, dann kann man wählen
                $Dropdown = getDropdownList("psubj[]", array("class" => $key, "id" => "FPF"), $Subject);//Die Klasse der Dropdown Liste ist der Key des Arrays, für spätere JS anwendung
                echo getHTMLObject("p", array(), $key);//Gibt nun den Key sichtbar als Titel aus
                echo $Dropdown;//Gibt das Dropdown menü aus
            }else{
                echo getHTMLObject("input", array("name" => "psubj[]", "value" => $Subject, "type" => "hidden"), "");//Das Fach ist nicht wählbar, also auch Hidden. Es wird als psubj an Marks.php übergeben.
            }
        }
    }
    /*Lädt die Wahlfächer
    Bei einem Array wird wieder eine Dropdownliste mit der Klasse des Keys ausgegeben. In JS werden damit dopplungen vermieden.
    Bei einem einzelnem Fach wird einfach nur ein Textlabel und ein Numberfeld erstellt.
    In dem Numberfeld wird angegeben wie oft man das Fach rein nimmt.
    Zudem wird in dem Label ein verstecktes Input feld gesetzt, um den Namen des Faches zu übergeben (subj)
    */
    function loadWFs(array $WF){
        $table = "";
        echo getHTMLObject("p", array(), "Wahlfächer");
        foreach($WF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("subj[]", array("class" => $key), $Subject);
                $TLabel = getHTMLObject("td", array("class" => "subjectLabelDD"), $Dropdown);
                $CountField = getHTMLObject("input", array("type" => "number", "min" => 0, "max" => 2, "step" => 1.0, "class" => "CountField", "value" => 0, "name" => "subjCount[]"), "");
                $TCount = getHTMLObject("td", array(), $CountField);
                $table = $table . getHTMLObject("tr", array(), $TLabel . $TCount);
            }else{
                $THiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                $TLabel = getHTMLObject("td", array("class" => "subjectLabel"), $Subject . $THiddenLabel);
                $CountField = getHTMLObject("input", array("type" => "number", "min" => 0, "max" => 2, "step" => 1.0, "class" => "CountField", "value" => 0, "name" => "subjCount[]"), "");
                $TCount = getHTMLObject("td", array(), $CountField);
                $table = $table . getHTMLObject("tr", array(), $TLabel . $TCount);
            }
        }
        echo getHTMLObject("table", array(), $table);
    }
?>