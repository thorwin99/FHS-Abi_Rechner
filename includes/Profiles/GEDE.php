<?php
    global $EAFGEDE;
    global $PFGESDE;
    global $NAGES;
    
    loadEAs($EAFGEDE);
    loadPFs($PFGESDE);
    
    function loadEAs(array $EAF){
        foreach($EAF as $Subject){
            echo getHTMLObject("input", array("name" => "easubj[]", "value" => $Subject, "type" => "hidden"), "");
        }
    }
    function loadPFs(array $PF){
        foreach($PF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("psubj[]", array(), $Subject);
                echo getHTMLObject("p", array(), $key);
                echo $Dropdown;
            }else{
                echo getHTMLObject("input", array("name" => "psubj[]", "value" => $Subject, "type" => "hidden"), "");
            }
        }
    }
    
?>