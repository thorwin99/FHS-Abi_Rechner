<?php
    global $EAFGEDE;
    global $PFGESDE;
    global $NAGES;
    
    loadEAs($EAFGEDE);

    
    function loadEAs(array $EAFGEDE){
        foreach($EAFGEDE as $Subject){
            echo getHTMLObject("input", array("name" => "easubj", "value" => $Subject, "type" => "hidden"), "");
        }
    }
    function loadPFs(array $_)
    
?>