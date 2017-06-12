<?php
    require_once 'includes/htmlObjectFunctions.php';
    $table = "";
    echo "Hallo";
    addEAMarks($table);
    addPSubjectMarks($table);
    
    echo getHTMLObject("table", array(), $table);

    function addEAMarks(&$table){
        foreach($_POST['easubj'] as $EASubject){
            $EMarkInputField = getHTMLObject("input", array("type" => "number", "name" => "emarks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0), "");   
            $EMarksTD = getHTMLObject("td", array(), $EMarkInputField);
            $label = getHTMLObject("td", array(), $EASubject);
            
            $table = $table . getHTMLObject("tr", array(), $label . $EMarksTD . $EMarksTD);
        }
    }
    function addPSubjectMarks(&$table){
        foreach($_POST['psubj'] as $PSubject){
            $MarkInputField = getHTMLObject("input", array("type" => "number", "name" => "marks[]", "min" => 0, "max" => 15, "step" => 1.0, "value" => 0), "");   
            $MarksTD = getHTMLObject("td", array(), $MarkInputField);
            $label = getHTMLObject("td", array(), $PSubject);
            
            $table = $table . getHTMLObject("tr", array(), $label . $MarksTD . $MarksTD);
        }
    }
?>