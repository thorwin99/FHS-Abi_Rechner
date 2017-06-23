   <?php
    require_once 'includes/htmlObjectFunctions.php';
    $table = "";

    addTableHeader($table);
    addEASubjects($table);
    addPSubjects($table);
    addPVSubject($table);
    addSubjects($table);

    echo getHTMLObject("h1", array(), "Noteneingabe");
    //echo createCardView("Gebe nun deine Noten ein", array(), "Noteneingabe");
    echo getHTMLObject("table", array(), $table);

    function addEASubjects(&$table){
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0), ""));
        
        foreach($_POST['easubj'] as $EASubject){
            $Label = getHTMLObject("td", array(), $EASubject);
            $emarkinput = getHTMLObject("input", array("type" => "number", "name" => "emarks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
            $pmarkinput = getHTMLObject("input", array("type" => "number", "name" => "pmarks[" . $EASubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "pinput", "required" => "required"), "");
            $mpmarkinput = getHTMLObject("input", array("type" => "number", "name" => "mpmarks[" . $EASubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "mpinput", "required" => "required"), "");
            $emtd = str_repeat(getHTMLObject("td", array(), $emarkinput), 4);
            $pmtd = getHTMLObject("td", array(), $pmarkinput);
            $mptd = getHTMLObject("td", array(), $mpmarkinput);
            
            $TRContent = $Label . $emtd . $pmtd;
            if(isset($_POST['mdlPrf'][$EASubject])){
                $TRContent = $TRContent . $mptd;
            }else{
                $TRContent = $TRContent . $empty;
            }
            $table = $table . getHTMLObject("tr", array(), $TRContent);
        }
    }
    function addPSubjects(&$table){
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0), ""));
        foreach($_POST['psubj'] as $PSubject){
            $Label = getHTMLObject("td", array(), $PSubject);
            $markinput = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
            $pmarkinput = getHTMLObject("input", array("type" => "number", "name" => "pmarks[" . $PSubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "pinput", "required" => "required"), "");
            $mpmarkinput = getHTMLObject("input", array("type" => "number", "name" => "mpmarks[" . $PSubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "mpinput", "required" => "required"), "");
            $mtd = str_repeat(getHTMLObject("td", array(), $markinput), 4);
            $pmtd = getHTMLObject("td", array(), $pmarkinput);
            $mptd = getHTMLObject("td", array(), $mpmarkinput);
            
            $TRContent = $Label . $mtd . $pmtd;
            if(isset($_POST['mdlPrf'][$PSubject])){
                $TRContent = $TRContent . $mptd;
            }else{
                $TRContent = $TRContent . $empty;
            }
            $table = $table . getHTMLObject("tr", array(), $TRContent);
        }
        
    }
    function addPVSubject(&$table){
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0), ""));
        $PSubject = $_POST['p5subj'];
        $Label = getHTMLObject("td", array(), $PSubject);
        $markinput = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
        $mpmarkinput = getHTMLObject("input", array("type" => "number", "name" => "mpmarks[" . $PSubject . "]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "class" => "mpinput", "required" => "required"), "");
        $MarkCount = $_POST['subjamount'][array_search($PSubject, $_POST['subj'])];
        $mtd = str_repeat(getHTMLObject("td", array(), $markinput), $MarkCount);
        $mptd = getHTMLObject("td", array(), $mpmarkinput);

        $TRContent = $Label . $mtd . str_repeat($empty, 4-$MarkCount) . $empty . $mptd;
        $table = $table . getHTMLObject("tr", array(), $TRContent);
    }
    
    function addSubjects(&$table){
        $empty = getHTMLObject("td", array(), getHTMLObject("input", array("disabled" => "disabled", "type" => "number", "value" => 0, "required" => "required"), ""));
        foreach($_POST['subj'] as $key => $Subject){
            if($Subject == $_POST['p5subj'])continue;
            $Label = getHTMLObject("td", array(), $Subject);
            $markinput = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");
            $mtd = str_repeat(getHTMLObject("td", array(), $markinput), $_POST['subjamount'][$key]);

            $TRContent = $Label . $mtd . str_repeat($empty, 6 - $_POST['subjamount'][$key]);
            $table = $table . getHTMLObject("tr", array(), $TRContent);
        }
    }
    function addTableHeader(&$table){
        $headtr = getHTMLObject("th", array(), "Fach");
        for($i = 1; $i <= 4; $i++){
            $headtr = $headtr . getHTMLObject("th", array(), $i . ". Note");
        }
        $headtr = $headtr . getHTMLObject("th", array(), "Prüfung") . getHTMLObject("th", array(), "Mündliche");
        $table = $table . getHTMLObject("tr", array(), $headtr);
    }
?>