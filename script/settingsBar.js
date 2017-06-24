$(document).ready(isReady);
function isReady(){
    changeProf();//Init language field
    
    
    $("#profil").change(changeProf);
    function changeProf(){
        var value = $("#profil").val();
        if(value == "GE" || value == "WL"){//Verstecke oder zeige Fachsprache Feld, jenachdem das Fach das benötigt.
            $(".language").show();
        }else{
            $(".language").hide();
        }
    }
}