$(document).ready(isReady);
function isReady(){
    $("#language").show();
    $("#profilSelect").change(function(){//Wenn ein Profil ausgewählt wird
        var value = $(this).val();//Das Profil
        if(value == "GE" || value == "WL"){//Wenn das Profil Wirtschaft oder Deutsch ist, zeige das Sprachauswahlfeld
            $("#language").show();
        }else{
            $("#language").hide();
        }
        
    });
}