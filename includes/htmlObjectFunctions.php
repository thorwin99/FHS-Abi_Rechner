<?php

    function getHTMLObject($name, array $attributes, $content){
        
        $_parent = "<" . $name . " ";
        foreach($attributes as $key => $value){
            $_parent = $_parent . getAttribute($key, $value);
        }
        $_parent = $_parent . ">" . $content . "</" . $name . ">";
        return $_parent;
    }
    function getAttribute($name, $value){
        return $name . "=\"" . $value . "\"";
    }
    function getDropdownList($name, array &$attributes, array $options){
        $attributes["name"] = $name;
        $options = "";
        foreach($list as $key => $value){
            $options = $options . getHTMLObject("option", array("value" => $key), $value);
        }
        return getHTMLObject("select", $attributes, $options);
    }
?>