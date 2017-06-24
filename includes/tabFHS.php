<?php
    require_once 'includes/htmlObjectFunctions.php';
    $table = "";
    addTableHeader($table);
    addEAMarks($table);
    addPSubjectMarks($table);
    addWSubjectMarks($table);
    
    echo getHTMLObject("h1", array(), "Noteneingabe");
    //echo createCardView("Gebe nun deine Noten ein", array(), "Noteneingabe");
    echo getHTMLObject("table", array(), $table);

    /*
    Erstellt die Tabelle für e.A. Fächern basierend auf easubj aus $_POST
    */
    function addEAMarks(&$table){
        foreach($_POST['easubj'] as $EASubject){
            $EMarkInputField = getHTMLObject("input", array("type" => "number", "name" => "emarks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");   
            $EMarksTD = getHTMLObject("td", array(), $EMarkInputField);
            $label = getHTMLObject("td", array(), $EASubject);
            
            $table = $table . getHTMLObject("tr", array(), $label . $EMarksTD . $EMarksTD);
        }
    }
    /*
    Erstellt die Tabelle für Pflicht Fächer basierend auf psubj aus $_POST
    */
    function addPSubjectMarks(&$table){
        foreach($_POST['psubj'] as $PSubject){
            $MarkInputField = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");   
            $MarksTD = getHTMLObject("td", array(), $MarkInputField);
            $label = getHTMLObject("td", array(), $PSubject);
            
            $table = $table . getHTMLObject("tr", array(), $label . $MarksTD . $MarksTD);
        }
    }
     /*
    Erstellt die Tabelle für die Wahl Fächern basierend auf subj aus $_POST und der anzahl der Fächer aus subjCount aus $_POST
    Der $key ist 0 oder 1 oder 2 und entspricht in beiden arrays (subj und sunjCount) dem gleichem Fach.
    */
    function addWSubjectMarks(&$table){
        foreach($_POST['subj'] as $key => $Subject){
            $MarkInputField = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0, "required" => "required"), "");   
            $MarksTD = getHTMLObject("td", array(), $MarkInputField);
            $label = getHTMLObject("td", array(), $Subject);
            $MarkTDs = "";
            for($i = 0; $i <$_POST['subjCount'][$key]; $i++){
                $MarkTDs = $MarkTDs . $MarksTD;
            }
            $table = $table . getHTMLObject("tr", array(), $label . $MarkTDs);
            
            
        }
    }
    
    function addTableHeader(&$table){
        $headtr = getHTMLObject("th", array(), "Fach");
        for($i = 1; $i <= 2; $i++){
            $headtr = $headtr . getHTMLObject("th", array(), $i . ". Note");
        }
        $table = $table . getHTMLObject("tr", array(), $headtr);
    }
?>