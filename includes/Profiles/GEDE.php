<?php
    global $_EAFGEDE;
    global $_PFGESDE;
    global $_NAGES;
    
    loadEAs();

    
    function loadEAs(array $_EAFGEDE){
        foreach($_EAFGEDE as $Subject){
            echo getHTMLObject("input", array("name" => "easubj", "value" => $Subject, "type" => "hidden"));
        }
        
        
    }
    
    
?>