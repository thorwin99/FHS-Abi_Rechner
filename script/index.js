$(document).ready(isReady);
function isReady(){
	var canSubmit = false;
    var languageSet = false
    
	//Submit form
	$("#form").submit(function(event){
		
		if(!canSubmit){
			$("#order").html("Wähle dein Profil");
			$("#profil").css("display", "contents");
			$("#absch").css("display", "none");
			canSubmit = true;
			event.preventDefault();
		}else if(!languageSet){
			var value = $("#profil").find(":selected").attr("value");
            if(value == "GE" || value == "WL"){
                $("#order").html("Wähle die Sprache");
                $("#profil").css("display", "none");
                $("#absch").css("display", "none");
                $("#language").css("display", "contents");
                languageSet = true;
                event.preventDefault();
            }
		}
		
	});
}