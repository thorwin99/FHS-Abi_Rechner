<?php
    //CardView Hilfe Texte, Titel und onClick events
    $CVOnClick = "$(this).parent().parent().hide(500)";
    $CVTitlePFs = "Pflichtfächer";
    $CVTitleWFs = "Wahlfächer";
    $CVTitlePSubjects = "Prüfungsfächer";
    $CVTitleSubjects ="Pflichtfächer";
    $CVTitleNaWi = "Naturwissenschaften";
    $CVTextPFs = "Gebe hier deine Plichtfächer an, die du wählen möchtest.";
    $CVTextWFs = "Wähle hier 3 Fächer aus. Du kannst auch ein Fach zwei mal nehmen.";
    $CVTextWSubjects = "Wähle hier maximal 6 Noten aus, die du einbringen möchtest.";
    $CVTextPSubjects = "Wähle hier die Prüfungen und Ob du sie auch mündlich  einbringen willst, sowie das 5. Prüfungsfach.";
    $CVTextSubjects = "Wähle hier deine Pflichtfächer.";
    $CVTextNaWi = "Wähle hier die 1. und/oder 2. Naturwissenschaft aus.";
    $CVCloseBtn = "Schließen";

    /*Lädt die e.A. als verstecktes Feld*/
    function loadEAs(array $EAF){//Lädt die e.A. Fächer als verstecktes Input feld.
        foreach($EAF as $Subject){
            echo getHTMLObject("input", array("name" => "easubj[]", "value" => $Subject, "type" => "hidden"), "");
        }
    }
    /*Lädt die vorgegeben Fächer
    Bei einem Array wird eine Dropdownliste mit der Klasse des Keys ind einer ID FPF, für JS ausgegeben
    */
    function loadPFs(array $PF){
        //Globale Werte (Siehe Oben)
        global $CVOnClick;
        global $CVTextPFs;
        global $CVTitlePFs;
        global $CVCloseBtn;
        
        //TD Strings
        $FachTD = "";
        $CardTD = "";
        //Lädt alle vorgegebenen Fächer, wenn Array, in die $FachTD
        foreach($PF as $key => $Subject){
            if(gettype($Subject) == "array"){//Wenn das momentane PF ein array ist, dann kann man wählen
                $Dropdown = getDropdownList("psubj[]", array("class" => $key . " FPF"), $Subject);//Die Klasse der Dropdown Liste ist der Key des Arrays, für spätere JS anwendung
                $FachTD = $FachTD . getHTMLObject("h3", array(), $key);//Gibt nun den Key sichtbar als Titel aus
                $FachTD = $FachTD . $Dropdown;//Gibt das Dropdown menü aus
            }else{
                echo getHTMLObject("input", array("name" => "psubj[]", "value" => $Subject, "type" => "hidden"), "");//Das Fach ist nicht wählbar, also auch Hidden. Es wird als psubj an Marks.php übergeben.
            }
        }
        if($FachTD != ""){//Wenn es überhaubt diese Tabellenspalte gibt, wird eine Hilfe cardview erstellt
            $CardTD = createCardView($CVTextPFs, array($CVCloseBtn => $CVOnClick), $CVTitlePFs);
        }
        return getHTMLObject("tr", array(), getHTMLObject("td", array(), $FachTD) . getHTMLObject("td", array(), $CardTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
    /*Lädt die Wahlfächer
    Bei einem Array wird wieder eine Dropdownliste mit der Klasse des Keys ausgegeben. In JS werden damit dopplungen vermieden.
    Bei einem einzelnem Fach wird einfach nur ein Textlabel und ein Numberfeld erstellt.
    In dem Numberfeld wird angegeben wie oft man das Fach rein nimmt.
    Zudem wird in dem Label ein verstecktes Input feld gesetzt, um den Namen des Faches zu übergeben (subj)
    */
    function loadWFs(array $WF){
        //Globale Werte (Siehe Oben)
        global $CVOnClick;
        global $CVTextWFs;
        global $CVTitleWFs;
        global $CVCloseBtn;
        
        //TD Strings
        $table = "";
        $CardTD = "";
        $table = $table . getHTMLObject("h3", array(), "Wahlfächer");
        
        //Lädt alle Wahlfächer, in die $table (Table in TD)
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
        if($table != ""){//Wenn es überhaubt diese Tabellenspalte gibt, wird eine Hilfe cardview erstellt
            $CardTD = createCardView($CVTextWFs, array($CVCloseBtn => $CVOnClick), $CVTitleWFs);
        }
        $tableTD = getHTMLObject("table", array(), $table);
        return getHTMLObject("tr", array(), getHTMLObject("td", array(), $tableTD) . getHTMLObject("td", array(), $CardTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
    
    //Abi Funktionen
    /*Lädt die e.A. Fächer als versteckte Felder
    $EAF: Die e.A. Fächer
    */
    function loadEASubjects($EAF){
        foreach($EAF as $EASubject){
            $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "easubj[]", "value" => $EASubject), "");
            echo $HiddenLabel;
        }
    }
    /*Lädt die auswahl der Prüfungsfächer, wo man die Mündliche Prüfung ankreutzt.
    Bei einem Array wird natürlich auch eine Dropdown liste angegeben.
    Übergeben werden mündliche noten als mdlPrf[Fach].
    */
    function loadPSubjects($APF, $P5Array){
        //Gobale Werte(Siehe Oben)
        global $CVOnClick;
        global $CVTextPSubjects;
        global $CVTitlePSubjects;
        global $CVCloseBtn;
        
        //TD Strings
        $table = "";
        $CardTD = "";
        //Der Titel der TD
        $Title = getHTMLObject("h3", array(), "Prüfungsfächer");
        //Lädt die anderen Prüfungsfächer in die $table. Falls array, dann mit Dropdown als label
        foreach($APF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("Prf[" . $key . "]", array("class" => $key . " APF"), $Subject);
                $Label = getHTMLObject("td", array("class" => "subjectLabelDD"), $Dropdown);
                $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "mdlPrf[" . $key . "]", "value" => true, "class" => $key . " APF"), "");
                $TdCheck = getHTMLObject("td", array(), $Checkbox);
                $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
            }else{
                $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "Prf[" . $Subject . "]", "value" => $Subject), "");
                $Label = getHTMLObject("td", array("class" => "subjectLabel"), $Subject . $HiddenLabel);
                $Checkbox = getHTMLObject("input", array("type" => "checkbox", "name" => "mdlPrf[" . $Subject ."]", "value" => true), "");
                $TdCheck = getHTMLObject("td", array(), $Checkbox);
                $table = $table . getHTMLObject("tr", array(), $Label . $TdCheck);
            }
        }
        if($table != ""){//Wenn es überhaubt diese Tabellenspalte gibt, wird eine Hilfe cardview erstellt
            $CardTD = createCardView($CVTextPSubjects, array($CVCloseBtn => $CVOnClick), $CVTitlePSubjects);
        }
        $tableTD = getHTMLObject("table", array(), $table) . loadP5DropDown($P5Array);;
        return getHTMLObject("tr", array(), getHTMLObject("td", array(), $Title . $tableTD) . getHTMLObject("td", array(), $CardTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
    /*
    Lädt das P5 Fach als Dropdown
    */
    function loadP5DropDown($P5Array){
        $Title = getHTMLObject("h4", array(), "5. Prüfungsfach (mündlich)");
        $Dropdown = getDropdownList("p5subj", array("class" => "p5subject"), $P5Array);
        return $Title . $Dropdown;
    }
    /*Lädt alle anderen Fächer als verstecktes Feld, es sei denn es ist ein array, dann dropdown
    $type: Der typ. Kann IIF oder IVF sein, also 2 mal oder 4 mal eingebracht werden müssen
    $amount: Die Anzahl, wie oft die Fächer eingebracht werden müssen
    */
    function loadSubjects($FER, $type, $amount){
        //Gobale Werte(Siehe Oben)
        global $CVOnClick;
        global $CVTextSubjects;
        global $CVTitleSubjects;
        global $CVCloseBtn;
        
        //TD Strings
        $FachTD = "";
        //Lädt die anderen Vorgegebenen Fächer in $FachTD
        foreach($FER as $key => $Subject){
            if(gettype($Subject) == "array"){
                $FachTD = $FachTD . getHTMLObject("h3", array(), $key);//Titel für das Dropdown menu (Meistens nur Kulturfächer)
                $Dropdown = getDropdownList("subj[]", array("class" => $key . " " . $type), $Subject);
                $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => $amount), "");
                $FachTD = $FachTD . $Dropdown . $HiddenAmountField;
            }else{
                $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => $amount), "");
                echo $HiddenLabel . $HiddenAmountField;
            }
        }
        return getHTMLObject("tr", array(), getHTMLObject("td", array(), $FachTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
    /*Lädt die NawiFächer. Bei TG ist es eine extra funktion. Es wird entweder 1., 2. oder beide erzeugt, jenachdem ob in Profilesdata auch daten vorhanden sind.
    Die anzahl der noten für jedes Fach werden in subjamount[] übergeben. der index aus subj[] ist identisch mit dem aus subjamount[]
    */
    function loadNaWiSubjects($NAF, $NA){
        //Gobale Werte(Siehe Oben)
        global $CVOnClick;
        global $CVTextNaWi;
        global $CVTitleNaWi;
        global $CVCloseBtn;
        
        //TD Strings
        $FachTD = "";
        $CardTD = "";
        //Wenn überhaubt ein 1. Nawifach gewählt wird.
        if(sizeof($NAF) != 0){
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
        //Wenn überhaubt eine 2. gewählt wird.
        if(sizeof($NA) != 0){
            foreach($NA as $key => $Subject){
                if(gettype($Subject) == "array"){
                    if(sizeof($NAF) != 0){//Wenn die 1. Nicht gewählt wird, Muss noch ein anders Label erzeugt werden.
                        $FachTD = $FachTD . getHTMLObject("h4", array(), "2. Naturwissenschaft");
                    }else{
                        $FachTD = $FachTD . getHTMLObject("h3", array(), "Naturwissenschaften");
                        $FachTD = $FachTD . getHTMLObject("h4", array(), "1. Naturwissenschaft"); 
                    }
                    $Dropdown = getDropdownList("subj[]", array("class" => $key . " IINaWi"), $Subject);
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 2), "");
                    $FachTD = $FachTD . $Dropdown . $HiddenAmountField;
                }else{
                    $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                    $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 2), "");
                    echo $HiddenLabel . $HiddenAmountField;
                }
            }
        }
        if($FachTD != ""){//Wenn es überhaubt diese Tabellenspalte gibt, wird eine Hilfe cardview erstellt
            $CardTD = createCardView($CVTextNaWi, array($CVCloseBtn => $CVOnClick), $CVTitleNaWi);
            }
            return getHTMLObject("tr", array(), getHTMLObject("td", array(), $FachTD) . getHTMLObject("td", array(), $CardTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
    /*Gibt die 2. Fremdsprache als verstecktes Feld aus, damit in JS das feld an das Dropdown aus PSubjects angepasst werden kann.*/
    function loadSecLanguage($lang){
        $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $lang, "class" => "Fremdsprache"), "");
        $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 2), "");
        echo $HiddenLabel . $HiddenAmountField;
        $HiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $lang, "class" => "Fremdsprache APF"), "");
        $HiddenAmountField = getHTMLObject("input", array("type" => "hidden", "name" => "subjamount[]", "value" => 4), "");
        echo $HiddenLabel . $HiddenAmountField;
    }

    /*Lädt die Wahlfächer als Tabelle mit Titel/Dropdown und Auswahl, wie oft das Fach eingebracht wird.
    */
    function loadWSubjects($wsubj){
        //Gobale Werte(Siehe Oben)
        global $CVOnClick;
        global $CVTextWSubjects;
        global $CVTitleWFs;
        global $CVCloseBtn;
        
        //TD Strings
        $table = "";
        $CardTD = "";
        //Wenn überhaubt Wahlfächer vorhanden sind. Sonst kein Titel.
        if(sizeof($wsubj) != 0){
            $table = $table . getHTMLObject("h3", array(), "Wahlfächer");
        }
        //Fügt die Wahlfächer zu $table hinzu (siehe FHS loadWFs)
        foreach($wsubj as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("subj[]", array("class" => $key), $Subject);
                $TLabel = getHTMLObject("td", array("class" => "subjectLabelDD"), $Dropdown);
                $CountField = getHTMLObject("input", array("type" => "number", "min" => 0, "max" => 4, "step" => 2.0, "class" => "CountField", "value" => 0, "name" => "subjamount[]"), "");
                $TCount = getHTMLObject("td", array(), $CountField);
                $table = $table . getHTMLObject("tr", array("id" => "td" . $key), $TLabel . $TCount);
            }else{
                $THiddenLabel = getHTMLObject("input", array("type" => "hidden", "name" => "subj[]", "value" => $Subject), "");
                $TLabel = getHTMLObject("td", array("class" => "subjectLabel"), $Subject . $THiddenLabel);
                $CountField = getHTMLObject("input", array("type" => "number", "min" => 0, "max" => 4, "step" => 2.0, "class" => "CountField", "value" => 0, "name" => "subjamount[]"), "");
                $TCount = getHTMLObject("td", array(), $CountField);
                $table = $table . getHTMLObject("tr", array("id" => "td" . $Subject), $TLabel . $TCount);
            }
        }
        if($table != ""){//Wenn es überhaubt diese Tabellenspalte gibt, wird eine Hilfe cardview erstellt
            $CardTD = createCardView($CVTextWSubjects, array($CVCloseBtn => $CVOnClick), $CVTitleWFs);
        }
        $tableTD = getHTMLObject("table", array(), $table);
        return getHTMLObject("tr", array(), getHTMLObject("td", array(), $tableTD) . getHTMLObject("td", array(), $CardTD));//Gibt die TR zurück ans Hauptscript des Profils
    }
?>