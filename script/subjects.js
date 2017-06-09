$(document).ready(isReady);
function isReady(){
	//Submit form
	$("#form").submit(function(event){//Submit event des Forms. Kontrolliert mögliche fehler.
        var sum = 0;
        $(".markCountInput").each(function(){
            var value = $(this).val();
            sum += Number(value);
        });
        if(sum != 3){
            alert("Du musst 3 Fächer auswählen");
            event.preventDefault();
        }
        
        var subjDe = $("#Deutsch");
        var secEMark = $(".secemark").attr("value");
        if(secEMark == "Deutsch"){
            subjDe.remove();
        }
        
         $(".markCountInput").each(function(){
            var value = $(this).val();
            var id = $(this).attr("name").replace("Count", "");
            var itemClass = "." + id;
            if($(itemClass).length == 0){
                if(Number(value) > 0){
                    $('<input>').attr({
                        type: "hidden",
                        class: id,
                        value: id,
                        name: "wsubjs[]"
                    }).appendTo("#form");
                }
            }
        });
        
	});
    
    $(".secemark").click(function(){//Klick funktion der Radio buttons des 2. Hauptfaches.
        var field = $(this).attr("value");//Das aktuell ausgewählte 2. Hauptfach
        switch(field){
            case "Deutsch"://Wenn Deutsch ausgewählt wird, dann soll Englisch als 2. Fremdsprache wieder auswählbar sein.
                $("#lang").find("option[value='Englisch']").show();
                break;
            case "Englisch"://Wenn Englisch ausgewählt wird, wird es bei der 2. Fremdsprache entfernt.
                $("#lang").find("option[value='Englisch']").hide();
                $("#lang").find("option[value='Spanisch']").attr("selected", "selected");
                break;
            default:
                break;
        }
    });

    $(".markCountInput").change(function(){
        var val = $(this).val();
        var supName = $(this).attr("name");
        var sum = 0;
        $(".markCountInput").each(function(){
            var value = $(this).val();
            sum += Number(value);
        });
        $(".markCountInput").each(function(){
            var value = $(this).val();
            var name = $(this).attr("name");
            var max = 2;
            if(sum >= 2){
                max = 3-sum;
            }
            if(name != supName){
                if(!(value > max)){
                    $(this).attr("max", max);
                }
            }
            
        });
        
    });

    $("#DropFach0").change(function(){
        var value = $(this).find(":selected").attr("value");
        $("#inputFach0").attr("name", value + "Count");
    });
}