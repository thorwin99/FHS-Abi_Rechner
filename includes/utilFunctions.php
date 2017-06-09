<?php
    //DELETE THIS FILE LATER
    function writeTable($TableContent, $id = NULL, $class = NULL){
        $_id = ($id != NULL) ? getAttribute("id", $id) : "";
        $_class = ($class != null) ? getAttribute("class", $class) : "";
        
        echo"<table " . $_id . $_class . ">";
        echo $TableContent;
        echo "</table>";
        
    }
    function writeTR($tdata){	
		echo "<tr>";
		echo $tdata;
		echo "</tr>";
	}
	function getTdata($title, $content, $header, $id = NULL){
       
		if($header){
			return ("<th class=\"tableHeader\">" . $title . "</th>");
		}else{
			return ("<td class=\"tableTitle\">" . $title . "</td><td class=\"tableContent\">" . $content . "</td>");
		}
	}
    function getTd($content, array $settings){
       return getHTMLObject("td", $settings, $content);
    }
	function getRadio($name, $value, $class = NULL){
        $_class = ($class != NULL) ? getAttribute("class", $class) : "";
        
		return ("<input type=\"radio\" " . getAttribute("name", $name) . getAttribute("value", $value) . $_class . ">");
	}
    function getCheckbox($name, $value, array $attributes, $content = NULL){
        
        $attributes['name'] = $name;
        $attributes['value'] = $value;
        $attributes['type'] = "checkbox";
        
        return getHTMLObject("input", $attributes, $content);
        
    }
    function getInput($name, $type, array $set = NULL){
        $attr = " ";
        foreach($set as $key => $value){
             $attr = $attr . getAttribute($key, $value);
        }
        
        return ("<input type=\"" . $type . "\"" . getAttribute("name", $name) . $attr . "/>");
        
    }
    function getDropdownList($name, array $list, $id = NULL){//$list key is value of option
        $_id = ($id != NULL) ? getAttribute("id", $id) : "";
		$_select = "<select style=\"display:block;\" name=\"" . $name . "\"" . $_id . ">";
        foreach($list as $key => $value){
            $_select = $_select . "<option value=\"" . $key . "\">" . $value . "</option>";
        }
        $_select = $_select . "</select>";
        return $_select;
	}
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
    function redirect($url){
        
        header("Location: " . $url);
        
    }

    function arrayToKeyValueArray(array $inValues){
        $newarray = array();
        foreach($inValues as $value){
            $newarray[$value] = $value;
        }
        return $newarray;
    }
?>