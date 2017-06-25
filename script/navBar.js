$(document).ready(isReady);
function isReady(){
    if($(".settingBar").length == 0){//Keine einstellungen möglich, da kein Settingsbar objekt vorhanden
        $(".openSettings").hide();//Dann wird das Einstellungszeichen versteckt
    }
    var state = 0;//0 = closed 1 = opened
    $(".openSettings").click(function(){//Wenn das Einstellungszeichen gedrückt wird
        switch(state){
            //State ist closed, also öffne einstellungen und verschiebe die Seite um 200px nach rechts und zeige das Overlay
            case 0:
                $(".settingBar").css("transform", "translateX(0%)");
                $(".page").css("margin-left", $(".settingBar").width() + "px");
                $(".overlay").show(0).css("background-color", "rgba(0,0,0,0.5)");
                rotateSettingsWheel(-360);
                state = 1;
                break;
            //State ist opened, also schließe einstellungen und verschiebe die Seite um 200px nach links und verstecke das Overlay
            case 1:
                $(".settingBar").css("transform", "translateX(-100%)");
                $(".page").css("margin-left", "0");
                $(".overlay").css("background-color", "rgba(0,0,0,0)").hide(300);
                rotateSettingsWheel(360);
                state = 0;
                break;
            default:
                break;
        }
    });
    $(".overlay").click(function(){//Wenn das Overlay gedrückt wird
          switch(state){
            case 0:
                break;
            //State ist opened, also schließe einstellungen und verschiebe die Seite um 200px nach links und verstecke das Overlay
            case 1:
                $(".settingBar").css("transform", "translateX(-100%)");
                $(".page").css("margin-left", "0");
                $(".overlay").css("background-color", "rgba(0,0,0,0)");
                $(".overlay").hide(300);
                rotateSettingsWheel(360);
                state = 0;
                break;
            default:
                break;
        }
    });
    //Rotiert das Einstellungs Rad um degree
    function rotateSettingsWheel(degree){
        $(".rotator").css("transform", "rotate(" + degree + "deg)")
    }
}