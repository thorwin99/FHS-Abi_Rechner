$(document).ready(isReady);
function isReady(){
	var canSubmit = 0;
    var languageSet = false;
    
    /*$("#order").html("Wähle die Sprache");
    $("#profil").hide();
    $("#absch").show();
    $("#seclanguage").hide();
    $("#language").hide();*/
    $("#language").show();
    $("#profilSelect").change(function(){
        var value = $(this).val();
        if(value == "GE" || value == "WL"){
            $("#language").show();
        }else{
            $("#language").hide();
        }
        
    });
    
    
	//Submit form
	$("#form").submit(function(event){
		
		/*if(canSubmit == 0){
			$("#order").html("Wähle dein Profil");
			$("#profil").show();
			$("#absch").hide()
			canSubmit = 1;
			event.preventDefault();
        }else if(canSubmit == 1){
            $("#order").html("Wähle deine 2. Fremdsprache");
			$("#profil").hide();
            $("#seclanguage").show();
			canSubmit = 2;
			event.preventDefault();
		}else if(!languageSet){
			var value = $("#profil").find(":selected").attr("value");//Lädt den Wert/Selected des Feldes Profil
            if(value == "GE" || value == "WL"){//Nur bei Wirtschaft und Deutsch kann man eine Sprache wählen.
                $("#order").html("Wähle die Sprache");
                $("#profil").hide();
                $("#absch").hide();
                $("#seclanguage").hide();
                $("#language").show();
                languageSet = true;
                event.preventDefault();
            }
		}
		*/
	});
}