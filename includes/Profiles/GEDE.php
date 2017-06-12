<?php
    global $EAFGEDE;
    global $PFGESDE;
    global $FGESDE;
    
    loadEAs($EAFGEDE);
    loadPFs($PFGESDE);
    loadWFs($FGESDE);

    function loadEAs(array $EAF){
        foreach($EAF as $Subject){
            echo getHTMLObject("input", array("name" => "easubj[]", "value" => $Subject, "type" => "hidden"), "");
        }
    }
    function loadPFs(array $PF){
        foreach($PF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("psubj[]", array("class" => $key, "id" => "FPF"), $Subject);
                echo getHTMLObject("p", array(), $key);
                echo $Dropdown;
            }else{
                echo getHTMLObject("input", array("name" => "psubj[]", "value" => $Subject, "type" => "hidden"), "");
            }
        }
    }
    function loadWFs(array $WF){
        $table = "";
        
        foreach($WF as $key => $Subject){
            if(gettype($Subject) == "array"){
                $Dropdown = getDropdownList("psubj[]", array("class" => $key), $Subject);
                $TLabel = getHTMLObject("td", array(), $Dropdown);
                $CountField = getHTMLObject("input", array("type" => "number", "min" => 0, "max" => 2, "step" => 1.0, "class" => "CountField", "value" => 0), "");
                $TCount = getHTMLObject("td", array(), $CountField);
                $table = $table . getHTMLObject("tr", array(), $TLabel . $TCount);
            }else{
                $TLabel = getHTMLObject("td", array(), $Subject);
                $CountField = getHTMLObject("input", array("type" => "number", "min" => 0, "max" => 2, "step" => 1.0, "class" => "CountField", "value" => 0), "");
                $TCount = getHTMLObject("td", array(), $CountField);
                $table = $table . getHTMLObject("tr", array(), $TLabel . $TCount);
            }
        }
        echo getHTMLObject("table", array(), $table);
    }
?>