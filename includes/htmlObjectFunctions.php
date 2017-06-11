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
    function getDropdownList($name, array $attributes, array $options){
        $attributes["name"] = $name;
        $optionsString = "";
        foreach($options as $key => $value){
            $optionsString = $optionsString . getHTMLObject("option", array("value" => $value), $value);
        }
        return getHTMLObject("select", $attributes, $optionsString);
    }
    function redirect($url){
        
        header("Location: " . $url);
        
    }
?>