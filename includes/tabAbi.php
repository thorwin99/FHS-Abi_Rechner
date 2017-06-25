   <?php
    require_once 'includes/htmlObjectFunctions.php';
    $table = "";
    $subjP = array();
    $subjMP = array();
    $subjNorm = array();

    addTableHeader($table);
    addEASubjects();
    addPVSubject();
    addSubjects();
    
    foreach($subjP as $td){
        $table = $table . $td;
    }
    foreach($subjMP as $td){
        $table = $table . $td;
    }
    foreach($subjNorm as $td){
        $table = $table . $td;
    }

    echo getHTMLObject("h1", array(), "Noteneingabe");
    //echo createCardView("Gebe nun deine Noten ein", array(), "Noteneingabe");
    echo getHTMLObject("table", array(), $table);

    /*Fügt die e.A. Fächer zur $table hinzu
    &$table: Referenz zur angegebenen Variable.
    */
    function addEASubjects(){
        global $subjP;
        global $subjMP;
        global $subjNorm;
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0), ""));
        
        foreach($_POST['easubj'] as $EASubject){
            $Label = getHTMLObject("td", array("class" => "eaLabel"), $EASubject);
            $emarkinput = getHTMLObject("input", array("type" => "number", "name" => "emarks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
            $pmarkinput = getHTMLObject("input", array("type" => "number", "name" => "pmarks[" . $EASubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "pinput", "required" => "required"), "");
            $mpmarkinput = getHTMLObject("input", array("type" => "number", "name" => "mpmarks[" . $EASubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "mpinput", "required" => "required"), "");
            $emtd = str_repeat(getHTMLObject("td", array(), $emarkinput), 4);
            $pmtd = getHTMLObject("td", array(), $pmarkinput);
            $mptd = getHTMLObject("td", array(), $mpmarkinput);
            
            $prf = false;
            $mprf = false;
            $TRContent = $Label . $emtd;
            if(isset($_POST['Prf'][$EASubject])){
                $TRContent = $TRContent . $pmtd;
                $prf = true;
            }else{
                $TRContent = $TRContent . $empty;
            }
            if(isset($_POST['mdlPrf'][$EASubject])){
                $TRContent = $TRContent . $mptd;
                $mprf = true;
            }else{
                $TRContent = $TRContent . $empty;
            }
            $table = getHTMLObject("tr", array(), $TRContent);
            if($prf){
                array_push($subjP, $table);
            }else if($mprf){
                array_push($subjMP, $table);
            }else{
                array_push($subjNorm, $table);
            }
        }
    }
    /*Fügt das P5 Fach zur $table hinzu
    &$table: Referenz zur angegebenen Variable.
    */
    function addPVSubject(){
        global $subjMP;
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0), ""));
        $PSubject = $_POST['p5subj'];
        $Label = getHTMLObject("td", array(), $PSubject);
        $markinput = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
        $mpmarkinput = getHTMLObject("input", array("type" => "number", "name" => "mpmarks[" . $PSubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "mpinput", "required" => "required"), "");
        $MarkCount = $_POST['subjamount'][array_search($PSubject, $_POST['subj'])];
        $mtd = str_repeat(getHTMLObject("td", array(), $markinput), $MarkCount);
        $mptd = getHTMLObject("td", array(), $mpmarkinput);

        $TRContent = $Label . $mtd . str_repeat($empty, 4-$MarkCount) . $empty . $mptd;
        $table = getHTMLObject("tr", array(), $TRContent);
        
        array_push($subjMP, $table);
    }
    /*Fügt die restlichen Fächer hinzu Fächer zur $table hinzu
    &$table: Referenz zur angegebenen Variable.
    */
    function addSubjects(){
        global $subjP;
        global $subjMP;
        global $subjNorm;
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0, "required" => "required"), ""));
        foreach($_POST['subj'] as $key => $Subject){
            if($Subject == $_POST['p5subj'])continue;
            $Label = getHTMLObject("td", array(), $Subject);
            $markinput = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
            $mtd = str_repeat(getHTMLObject("td", array(), $markinput), $_POST['subjamount'][$key]);
            $pmarkinput = getHTMLObject("input", array("type" => "number", "name" => "pmarks[" . $Subject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "pinput", "required" => "required"), "");
            $mpmarkinput = getHTMLObject("input", array("type" => "number", "name" => "mpmarks[" . $Subject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "mpinput", "required" => "required"), "");
            $pmtd = getHTMLObject("td", array(), $pmarkinput);
            $mptd = getHTMLObject("td", array(), $mpmarkinput);
            $TRContent = $Label . $mtd . str_repeat($empty, 4 - $_POST['subjamount'][$key]);
            
            $prf = false;
            $mprf = false;
             if(isset($_POST['Prf'][$Subject])){
                $TRContent = $TRContent . $pmtd;
                 $prf = true;
            }else{
                $TRContent = $TRContent . $empty;
            }
            if(isset($_POST['mdlPrf'][$Subject])){
                $TRContent = $TRContent . $mptd;
                $mprf = true;
            }else{
                $TRContent = $TRContent . $empty;
            }
            $table = getHTMLObject("tr", array(), $TRContent);
            if($prf){
                array_push($subjP, $table);
            }else if($mprf){
                array_push($subjMP, $table);
            }else{
                array_push($subjNorm, $table);
            }
        }
    }
    /*Fügt einen Header zur $table hinzu
    &$table: Referenz zur angegebenen Variable.
    */
    function addTableHeader(&$table){
        $headtr = getHTMLObject("th", array(), "Fach");
        for($i = 1; $i <= 4; $i++){
            $headtr = $headtr . getHTMLObject("th", array(), $i . ". Note");
        }
        $headtr = $headtr . getHTMLObject("th", array(), "Prüfung") . getHTMLObject("th", array(), "Mündliche");
        $table = $table . getHTMLObject("tr", array(), $headtr);
    }
?>