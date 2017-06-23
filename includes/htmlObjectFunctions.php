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
    function createCardView($text, array $actions, $title = NULL){
        $title = ($title == NULL) ? "" : $title;
        $actionString = "";
        foreach($actions as $name => $onClick){
            $actionString = getHTMLObject("span", array("onClick" => $onClick), $name);
        }
        $htext = getHTMLObject("p", array(), $text);
        $htitle = getHTMLObject("span", array("class" => "cardTitle"), $title);
        $cardBody = getHTMLObject("div", array("class" => "cardBody"), $htitle . $htext);
        $cardActions = getHTMLObject("div", array("class" => "cardActions notSelectable"), $actionString);
        
        $cardView = "";
        if(sizeof($actions) == 0){
            $cardView = getHTMLObject("div", array("class" => "cardView noActions"), $cardBody);
        }else{
            $cardView = getHTMLObject("div", array("class" => "cardView"), $cardBody . $cardActions);
        }
        return $cardView;
    }
    function redirect($url){//Leitet den Browser zur url weiter
        
        header("Location: " . $url);
        
    }
?>