$(document).ready(isReady);
function isReady(){
	var canSubmit = 0;
    var languageSet = false;
    
	//Submit form
	$("#form").submit(function(event){
		
		/*if(canSubmit == 0){
			$("#order").html("Wähle dein Profil");
			$("#profil").css("display", "contents");
			$("#absch").css("display", "none");
			canSubmit = 1;
			event.preventDefault();
        }else if(canSubmit == 1){
            $("#order").html("Wähle deine 2. Fremdsprache");
			$("#profil").css("display", "none");
            $("#seclanguage").css("display", "contents");
			canSubmit = 2;
			event.preventDefault();
		}else if(!languageSet){
			var value = $("#profil").find(":selected").attr("value");//Lädt den Wert/Selected des Feldes Profil
            if(value == "GE" || value == "WL"){//Nur bei Wirtschaft und Deutsch kann man eine Sprache wählen.
                $("#order").html("Wähle die Sprache");
                $("#profil").css("display", "none");
                $("#absch").css("display", "none");
                $("#seclanguage").css("display", "none");
                $("#language").css("display", "contents");
                languageSet = true;
                event.preventDefault();
            }
		}
		
	});*/
}