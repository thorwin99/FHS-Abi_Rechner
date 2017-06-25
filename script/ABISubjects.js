var WSubjectCountSum = 0;
$(document).ready(isReady);
function isReady(){//Wird ausgeführt, wenn document geladen.
    onChangeNawiFach();
    onChangeDDAPF();
    onChangeFremdsprachFach();
    onChangeNawiFach();
    updateTGNawiSelection();
    onChangeNawiAPF();
    $("#subjectFrom").submit(submitForm);
    $(".INaWi").change(onChangeNawiFach);
    $(".IINaWi").change(onChangeSecNawiFach);
    $("select.APF").change(onChangeDDAPF);
    $("select.Fremdsprache.APF").change(onChangeFremdsprachFach);
    $("select.Naturwissenschaft.APF").change(onChangeNawiAPF);
    $(".NaWiCheckbox").change(updateTGNawiSelection);
    $(".CountField").change(onChangeCountNumber);//Wenn die Anzahl der Noten eines Faches eingestellt wird
    
    function submitForm(event){
        if($(".NaWiCheckbox").length != 0){//TG ausgewählt, da nur TG Nawicheckbox hat
            if($(".NaWiCheckbox:checked").length == 0){//Bei TG muss geprüft werden, ob überhaubt eine 2. Naturwissenschaft ausgewählt wurde, und die nicht ausgewählte 2. muss entfernt werden.
                alert("Du musst mindestens eine 2. Naturwissenschaft wählen");
                event.preventDefault();
            }else{
                $(".NaWiCheckbox").not(".NaWiCheckbox:checked").parent().parent().remove();
            }
        }
        updateTGNawiSelection(); 
        var nullSubjects = [];//Liste mit Fächern, die 0 mal eingebracht werden.

        var sumOfSubjects = 0;//Summe der Wahlnotenanzahl.
        $(".CountField").each(function(){//Für Jedes .CountField wird das ausgeführt
            var value = Number($(this).val());//Wert des Countfieldes (Anzahl einbringender Noten)
            sumOfSubjects += value;//Summe wird um Value erhöt
            if(value == 0){//Wenn value 0 dann wird die Tabellenzeile zu nullSubjects hinzugefügt
                nullSubjects.push($(this).parent().parent());
            }
        });
        for(i = 0; i < nullSubjects.length; i++){//Entferne alle Fächer mit 0 Noten eingebracht.
            nullSubjects[i].remove();
        }
    }
    
    function onChangeNawiFach(event){
        if(!$(".INaWi").length)return;
        var value = $(".Naturwissenschaft.INaWi").val();
        $(".Naturwissenschaft").not(".INaWi").find("option[value=" + value + "]").prop("disabled", true).removeAttr('selected');
        $(".Naturwissenschaft").not(".INaWi").find("option[value!=" + value + "]").show().removeAttr('selected').prop('selected', true);
        $(".Naturwissenschaft").not(".INaWi").trigger("chosen:updated");
    }
    
    function updateTGNawiSelection(){
        if($(".NaWiCheckbox").length != 0){
            var sumOfCheckboxes = $(".NaWiCheckbox:checked").length;
            if(sumOfCheckboxes == 0){
                sumOfCheckboxes = 1;
            }
            $(".NaWiCheckbox").each(function(){
                $(this).attr("value", 4/sumOfCheckboxes);
                if($(this).hasClass("Informatik")){
                    if($(".Informatik:checked").length != 0){
                        $("#tdInformatik").hide();
                        $("#tdInformatik").find(".CountField").val("0");
                    }else{
                        $("#tdInformatik").show();
                    }
                }
            });
        }
    }
    
    function onChangeDDAPF(event){
        $("select.APF").each(function(){
            var changedClass = $(this).attr("class").split(' ')[0];
            $("input." + changedClass + ".APF[type=checkbox]").attr("name", "mdlPrf[" + $("select." + changedClass + ".APF").val() + "]");//Setzt den Namen der Checkbox auf das Ausgewählte element in der Dropdown Liste
            $("select." + changedClass + ".APF").attr("name", "Prf[" + $("select." + changedClass + ".APF").val() + "]");       
                       
        });
    }
    
    function onChangeFremdsprachFach(event){
        if($(".Fremdsprache.APF").length != 0){
            newVal = $(".Fremdsprache.APF").val();
            otherVal = $(".Fremdsprache.APF").find("option[value!=" + newVal + "]").val();
            $(".Fremdsprache").not(".APF").val(otherVal);
            $("input.Fremdsprache.APF[type=hidden]").val(newVal);
        }
    }
    
    function onChangeCountNumber(event){
        var newValue = Number($(this).val());//Der neue Feld eines CountField's
        FSubjectCountSum = getSubjectCountSum();//Lädt die aktuelle summe aller Countfield's
        var max = (FSubjectCountSum > 4) ? 6-FSubjectCountSum : 4;//Wenn Diese über 4, dann wird das Maximum aller CountFields herabgesetzt
        $(".CountField").each(function(){
            var currentFieldValue = Number($(this).val());//Der wert des momentanen Feldes
            if(max == 0){//wenn max = 0 dann soll das Maximum aller auf seinen jetzigen wert gesetzt werde, sodass man nichts erhöhen kann
                $(this).attr("max", currentFieldValue);
            }else if(!(currentFieldValue >= max)){//Sonst wird das Maximum bei allen Feldern unter max auf max gesetzt.
                $(this).attr("max", max);
            }
        
        });
    }

    function onChangeSecNawiFach(event){
        var value = $(".IINaWi").val();
        if(value == "Informatik"){
            $("#tdInformatik").css("visibility", "hidden");
            $("#tdInformatik").children("td.CountField").val(0);
            onChangeCountNumber();
        }else{
            $("#tdInformatik").css("visibility", "visible");
        }
    }
    
    function onChangeNawiAPF(event){
        var value = $("select.Naturwissenschaft.APF").val();
        if(value == "Mathe"){
            $("select.Fremdsprache.APF").find("option[value=Englisch]").show().removeAttr('selected').prop('selected', true);
            $("select.Fremdsprache.APF").find("option[value!=Englisch]").prop("disabled", false);
            $("select.Fremdsprache.APF").trigger("chosen:updated");
            updateNaWiSubjects();
        }else{
            $("select.Fremdsprache.APF").find("option[value=Englisch]").show().removeAttr('selected').prop('selected', true);
            $("select.Fremdsprache.APF").find("option[value!=Englisch]").prop("disabled", true).removeAttr('selected');
            $("select.Fremdsprache.APF").trigger("chosen:updated");
            updateNaWiSubjects();
        }
        
    }

    function getSubjectCountSum(){//Zählt die anzahl der Wahlnoten zusammen. Max sind 3
        var sumOfSubjects = 0;
        $(".CountField").each(function(){
            var value = Number($(this).val());
            sumOfSubjects += value;
        });
        return sumOfSubjects;
    }
    
    function updateNaWiSubjects(){
        var value = $("select.Naturwissenschaft.APF").val();
        if($(".INaWi").length != 0){//1. Naturwissenschaft existiert
            if(value != "Mathe"){
                $(".INaWi").find("option[value=" + value + "]").show().prop("disabled", false).removeAttr('selected').prop('selected', true);
                $(".INaWi").find("option[value!=" + value + "]").prop("disabled", true).removeAttr('selected');
            }else{
                $(".INaWi").find("option").show().prop("disabled", false);
            }
            onChangeNawiFach();
        }else{
            if(value != "Mathe"){
                $(".IINaWi").find("option[value=" + value + "]").show().prop("disabled", false).removeAttr('selected').prop('selected', true);
                $(".IINaWi").find("option[value!=" + value + "]").prop("disabled", true).removeAttr('selected');
            }else{
                $(".IINaWi").find("option").show().prop("disabled", false);
            }
        }
    }
    $(".INaWi").trigger("chosen:updated");
    $(".IINaWi").trigger("chosen:updated");
}