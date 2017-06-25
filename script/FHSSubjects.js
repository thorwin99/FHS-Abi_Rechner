var FSubjectCountSum = 0;
$(document).ready(isReady);
function isReady(){//Wird ausgeführt, wenn document geladen.
    onChangeFremdsprachFach();//Die Dropdownlisten werden so eingestellt, dass keine Dopplung vorhanden ist.
    onChangeNawiFach();//Die Dropdownlisten werden so eingestellt, dass keine Dopplung vorhanden ist.
    $("#subjectFrom").submit(formSubmit);//Wenn Formular abgesendet wird
    $(".CountField").change(onChangeCountNumber);//Wenn die Anzahl der Noten eines Faches eingestellt wird
    $(".Fremdsprache.FPF").change(onChangeFremdsprachFach);//Wenn man eine Dropdownliste ändert
    $(".Naturwissenschaft.FPF").change(onChangeNawiFach);
}
function formSubmit(event){
    var nullSubjects = [];//Liste mit Fächern, die 0 mal eingebracht werden.
    var sumOfSubjects = 0;//Summe der Wahlnotenanzahl.
    $(".CountField").each(function(){//Für Jedes .CountField wird das ausgeführt
        var value = Number($(this).val());//Wert des Countfieldes (Anzahl einbringender Noten)
        sumOfSubjects += value;//Summe wird um Value erhöt
        if(value == 0){//Wenn value 0 dann wird die Tabellenzeile zu nullSubjects hinzugefügt
            nullSubjects.push($(this).parent().parent());
        }
    });
    if(sumOfSubjects != 3){//Kann nicht absenden.
        alert("Du musst 3 Wahlfächer auswählen!");
        event.preventDefault();
    }else{//Kann absenden
        for(i = 0; i < nullSubjects.length; i++){//Entferne alle Fächer mit 0 Noten eingebracht.
            nullSubjects[i].remove();
        }
    }
    
}
function onChangeCountNumber(event){
    var newValue = Number($(this).val());//Der neue Feld eines CountField's
    FSubjectCountSum = getSubjectCountSum();//Lädt die aktuelle summe aller Countfield's
    var max = (FSubjectCountSum > 2) ? 3-FSubjectCountSum : 2;//Wenn Diese über gleich 2, dann wird das Maximum aller CountFields herabgesetzt
    $(".CountField").each(function(){
        var currentFieldValue = Number($(this).val());//Der wert des momentanen Feldes
        if(max == 0){//wenn max = 0 dann soll das Maximum aller auf seinen jetzigen wert gesetzt werde, sodass man nichts erhöhen kann
            $(this).attr("max", currentFieldValue);
        }else if(!(currentFieldValue >= max)){//Sonst wird das Maximum bei allen Feldern unter max auf max gesetzt.
            $(this).attr("max", max);
        }
        
    });
}
function onChangeFremdsprachFach(event){//Andert die Dropdownlisten der Fremdsprachen so, dass sie gegengesetzt sind.
    if(!$(".Fremdsprache.FPF").length)return;
    var value = $(".Fremdsprache.FPF").val();
    $(".Fremdsprache").not(".FPF").find("option[value=" + value + "]").prop("disabled", true).removeAttr('selected');
    $(".Fremdsprache").not(".FPF").find("option[value!=" + value + "]").prop("disabled", false).removeAttr('selected').prop('selected', true).trigger("chosen:updated");
}
function onChangeNawiFach(event){
    if(!$(".Naturwissenschaft.FPF").length)return;
    var value = $(".Naturwissenschaft.FPF").val();
    $(".Naturwissenschaft").not(".Naturwissenschaft.FPF").find("option[value=" + value + "]").prop("disabled", true).removeAttr('selected');
    $(".Naturwissenschaft").not(".Naturwissenschaft.FPF").find("option[value!=" + value + "]").prop("disabled", false).removeAttr('selected').prop('selected', true).trigger("chosen:updated");
}//Andert die Dropdownlisten der Nawi so, dass sie gegengesetzt sind.
function getSubjectCountSum(){//Zählt die anzahl der Wahlnoten zusammen. Max sind 3
    var sumOfSubjects = 0;
    $(".CountField").each(function(){
        var value = Number($(this).val());
        sumOfSubjects += value;
    });
    return sumOfSubjects;
}
/*function checkDoubles(){
    
    var classFs = $(".Fremdsprache");
    if(classFs[0].val() == classFS[1].val()){
        return true;
    }
    var classFsNawi = $(".Naturwissenschaft");
    if(classNawi[0].val() == classNawi[1].val()){
        return true;
    }
}*/