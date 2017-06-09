<?php
    $emarks = array($_EMARKS[$_POST['profil']], $_POST['secemark']);
    $title = getTdata("Fächer", NULL, true);
    $eMarksInput = getInput("emarks[]", "number", array("min" => 0, "max" => 15, "step" => 1.0, "value" => 0));
    $marksInput = getInput("marks[]", "number", array("min" => 0, "max" => 15, "step" => 1.0, "value" => 0));
    $table = "";
    for($i = 0; $i < count($emarks); $i++){
        $eMarksTd = getTdata($emarks[$i], $eMarksInput, false) . getTd($eMarksInput, array());
        $table = $table . getHTMLObject("tr", array(), $eMarksTd);//Add EMark row
    }

    //Generate Table
    for($i = 0; $i < count($_POST['subjs']); $i++){
        
        $table = $table .  getHTMLObject("tr", array(), getTdata($_POST['subjs'][$i], $marksInput, false) . getTd($marksInput, array()));
        
    }
     for($i = 0; $i < count($_POST['wsubjs']); $i++){
        
         if($_POST[$_POST['wsubjs'][$i] . "Count"] == 2){
              $table = $table .  getHTMLObject("tr", array(), getTdata($_POST['wsubjs'][$i], $marksInput, false) . getTd($marksInput, array()));
         }else{
              $table = $table .  getHTMLObject("tr", array(), getTdata($_POST['wsubjs'][$i], $marksInput, false));
         }
    }
    writeTable($table);
    //Lade ausgewählte fächer
?>