<?php
    function loadFHSSubjectChooser(){
        global $EAFER;//Siehe ProfileData.php
        global $PFER;//Siehe ProfileData.php
        global $FER;//Siehe ProfileData.php
        loadEAs($EAFER);
        loadPFs($PFER);
        loadWFs($FER);
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