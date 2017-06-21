$(document).ready(isReady);
function isReady(){
    if($(".settingBar").length == 0){//Keine einstellungen möglich
        $(".openSettings").hide();
        console.log("hide");
    }
    var state = 0;//0 = closed 1 = opened
    $(".openSettings").click(function(){
        switch(state){
            case 0:
                $(".settingBar").css("width", "200px");
                $(".page").css("margin-left", "200px");
                $(".overlay").show().css("background-color", "rgba(0,0,0,0.5)");
                rotateSettingsWheel(-360);
                state = 1;
                break;
            case 1:
                $(".settingBar").css("width", "0");
                $(".page").css("margin-left", "0");
                $(".overlay").css("background-color", "rgba(0,0,0,0)").hide(300);
                rotateSettingsWheel(360);
                state = 0;
                break;
            default:
                break;
        }
    });
    $(".overlay").click(function(){
          switch(state){
            case 0:
                break;
            case 1:
                $(".settingBar").css("width", "0");
                $(".page").css("margin-left", "0");
                $(".overlay").css("background-color", "rgba(0,0,0,0)").hide(300);
                state = 0;
                break;
            default:
                break;
        }
    });
    
    function rotateSettingsWheel(degree){
        $(".rotator").css("transform", "rotate(" + degree + "deg)")
        
        
    }
}