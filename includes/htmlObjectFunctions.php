<?php
    /*Erstellt die Zeichenkette für ein HTML Objekt
    $name: Der name des Objekts bspl: "img"
    $attributes: Die einstellungen des Elements, wie Class oder Id
    $content: Der inhalt des Objectes, also alles, was zwischen dem Öfnenden und Schließenden Tag steht. 
    */
    function getHTMLObject($name, array $attributes, $content){//Erstellt einen String eines HTML objektes
        
        $_parent = "<" . $name . " ";
        foreach($attributes as $key => $value){
            $_parent = $_parent . getAttribute($key, $value);
        }
        $_parent = $_parent . ">" . $content . "</" . $name . ">";
        return $_parent;
    }
    /*Erstellt die Zeichenkette für ein Attribut.
    $name: Name des Attributes z.B. "id"
    $value: Wert des Attributes z.B. "eineID"
    */
    function getAttribute($name, $value){//Erstellt einen String des Attributes name="value"
        return $name . "=\"" . $value . "\"";
    }
    /*Erstellt die Zeichenkette für eine Dropdownliste
    $name: Name der Dropdownliste. Später im POST abrufbar
    $attributes: Die einstellungen des Elements, wie Class oder Id
    $options: Ein Array mit den option Werten sowie Anzeigenamen
    */
    function getDropdownList($name, array $attributes, array $options){//Erstellt den String einer Dropdown Liste
        $attributes["name"] = $name;
        $optionsString = "";
        foreach($options as $key => $value){
            $optionsString = $optionsString . getHTMLObject("option", array("value" => $value), $value);
        }
        return getHTMLObject("select", $attributes, $optionsString);
    }
    /*Erstellt eine CardView
    $text: Text, der in der Karte angezeigt wird.
    $actions: Die Knöpfe unter der Karte, mit dem jeweiligem onClick event.
    $title: Optional - Wenn angegeben, der Titel der Karte am oberen Rand
    */
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
    /*Leitet den nutzer weiter
    $url: Die url, wohin der nutzer geleitet werden soll.
    */
    function redirect($url){//Leitet den Browser zur url weiter
        
        header("Location: " . $url);
        
    }
?>