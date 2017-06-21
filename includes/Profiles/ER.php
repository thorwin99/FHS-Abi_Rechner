<?php
    include 'includes/subjectTableFunctions.php';

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
        loadSecLanguage($_POST['seclanguage']);
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
    function loadSecLanguage($lang){
        $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $lang, "class" => "Fremdsprache"), "");
        $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 2), "");
        echo $HiddenLabel . $HiddenAmountField;
    }
?>