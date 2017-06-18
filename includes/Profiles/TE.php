<?php
    //Funktion siehe ER.php
    function loadFHSSubjectChooser(){
        global $EAFTE;
        global $PFTE;
        global $FTE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadEAs($EAFTE);
        loadPFs($PFTE);
        loadWFs($FTE);
    }

    function loadAbiSubjectChooser(){
        global $EAFTE;
        global $APFTE;
        global $P5Array;
        global $IVFTE;
        global $IIFTE;
        global $NAFTE;
        global $NATE;
        global $LANGUAGES;
        array_push($LANGUAGES, $_POST['seclanguage']);//Fügt die 2. Fremdsprache zu der anderen hinzu
        
        loadPSubjects($EAFTE, $APFTE);
        loadP5DropDown($P5Array);
        loadSubjects($IVFTE, "IVF", 4);
        loadSubjects($IIFTE, "IIF", 2);
        loadNaWiSubjects($NAFTE, $NATE);
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
        if(sizeof($NAF) != 0){//1. Nawi
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
        if(sizeof($NA) != 0){//2. Nawi
            $table = "";
            foreach($NA as $key => $Subject){
                if(gettype($Subject) == "array"){
                    echo getHTMLObject("h3", array(), "2. Naturwissenschaft");
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
            echo getHTMLObject("table", array(), $table);
        }
    }

    function loadEAs(array $EAF){
        foreach($EAF as $Subject){
            echo getHTMLObject("input", array("name" => "easubj[]", "value" => $Subject, "type" => "hidden"), "");
        }
    }
    function loadPFs(array $PF){
        foreach($PF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("psubj[]", array("class" => $key, "id" => "FPF"), $Subject);
                echo getHTMLObject("p", array(), $key);
                echo $Dropdown;
            }else{
                echo getHTMLObject("input", array("name" => "psubj[]", "value" => $Subject, "type" => "hidden"), "");
            }
        }
    }
    function loadWFs(array $WF){
        $table = "";
        
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