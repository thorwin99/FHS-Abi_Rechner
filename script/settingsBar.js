$(document).ready(isReady);
function isReady(){
	var canSubmit = false;
    var languageSet = false;
    changeProf();//Init language field
    
    
    $("#profil").change(function (event){
        changeProf();
    });
    function changeProf(){
        var value = $("#profil").val();
        if(value == "GE" || value == "WL"){
            $("#language").css("display", "block");
        }else{
            $("#language").css("display", "none");
        }
    }
}