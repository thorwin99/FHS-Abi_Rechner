var WSubjectCountSum = 0;
$(document).ready(isReady);
function isReady(){//Wird ausgeführt, wenn document geladen.
    onChangeNawiFach();
    onChangeDDAPF();
    onChangeFremdsprachFach();
    updateTGNawiSelection();
    $("#subjectFrom").submit(submitForm);
    $(".INaWi").change(onChangeNawiFach);
    $("select.APF").change(onChangeDDAPF);
    $(".Fremdsprache.APF").change(onChangeFremdsprachFach);
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
        $(".Naturwissenschaft").not(".INaWi").find("option[value=" + value + "]").hide().removeAttr('selected');
        $(".Naturwissenschaft").not(".INaWi").find("option[value!=" + value + "]").show().removeAttr('selected').attr('selected','selected');
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
            });
        }
    }
    
    function onChangeDDAPF(event){
        $("input.APF[type=checkbox]").attr("name", "mdlPrf[" + $("select.APF").val() + "]");
    }
    
    function onChangeFremdsprachFach(event){
        newVal = $(".Fremdsprache.APF").val();
        otherVal = $(".Fremdsprache.APF").find("option[value!=" + newVal + "]").val();
        $(".Fremdsprache").not(".APF").val(otherVal);
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
    
    function getSubjectCountSum(){//Zählt die anzahl der Wahlnoten zusammen. Max sind 3
        var sumOfSubjects = 0;
        $(".CountField").each(function(){
            var value = Number($(this).val());
            sumOfSubjects += value;
        });
        return sumOfSubjects;
    }
}