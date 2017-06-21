$(document).ready(isReady);
function isReady(){
    $("#language").show();
    $("#profilSelect").change(function(){
        var value = $(this).val();
        if(value == "GE" || value == "WL"){
            $("#language").show();
        }else{
            $("#language").hide();
        }
        
    });
}