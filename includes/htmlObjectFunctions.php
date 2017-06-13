<?php

    function getHTMLObject($name, array $attributes, $content){//Erstellt einen String eines HTML objektes
        
        $_parent = "<" . $name . " ";
        foreach($attributes as $key => $value){
            $_parent = $_parent . getAttribute($key, $value);
        }
        $_parent = $_parent . ">" . $content . "</" . $name . ">";
        return $_parent;
    }
    function getAttribute($name, $value){//Erstellt einen String des Attributes name="value"
        return $name . "=\"" . $value . "\"";
    }
    function getDropdownList($name, array $attributes, array $options){//Erstellt den String einer Dropdown Liste
        $attributes["name"] = $name;
        $optionsString = "";
        foreach($options as $key => $value){
            $optionsString = $optionsString . getHTMLObject("option", array("value" => $value), $value);
        }
        return getHTMLObject("select", $attributes, $optionsString);
    }
    function redirect($url){//Leitet den Browser zur url weiter
        
        header("Location: " . $url);
        
    }
?>