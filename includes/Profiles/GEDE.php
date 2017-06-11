<?php
    global $EAFGEDE;
    global $PFGESDE;
    global $NAGES;
    
    loadEAs($EAFGEDE);
    loadPFs($PFGESDE);
    loadNFs($NAGES);

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
    function loadNFs(array $NF){
        if(sizeof($NF) > 1){
            $Dropdown = getDropdownList("psubj[]", array(), $NF);
            echo getHTMLObject("p", array(), "Naturwissenschaft");
            echo $Dropdown;
        }else{
            echo getHTMLObject("input", array("name" => "psubj[]", "value" => $NF[0], "type" => "hidden"), "");
        }
    }
    
?>