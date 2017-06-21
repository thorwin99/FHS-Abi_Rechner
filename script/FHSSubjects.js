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
    var Subjects = [];//Liste mit Fächern, die eingebracht werden.
    var sumOfSubjects = 0;//Summe der Wahlnotenanzahl.
    $(".CountField").each(function(){//Für Jedes .CountField wird das ausgeführt
        var value = Number($(this).val());//Wert des Countfieldes (Anzahl einbringender Noten)
        sumOfSubjects += value;//Summe wird um Value erhöt
        if(value == 0){//Wenn value 0 dann wird die Tabellenzeile zu nullSubjects hinzugefügt
            nullSubjects.push($(this).parent().parent());
        }else{//Sonst wird die Tabellenzeile zu Subjects hinzugefügt
            Subjects.push($(this).parent().parent());
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
    var max = (FSubjectCountSum >= 2) ? 3-FSubjectCountSum : 2;//Wenn Diese über gleich 2, dann wird das Maximum aller CountFields herabgesetzt
    $(".CountField").each(function(){
        var currentFieldValue = Number($(this).val());
        if(!(currentFieldValue > max)){//Max wird nur herabgesetzt, wenn currentFieldValue <= max ist, da sonst nicht absendbar
            $(this).attr("max", max);
        }
        
    });
}
function onChangeFremdsprachFach(event){//Andert die Dropdownlisten der Fremdsprachen so, dass sie gegengesetzt sind.
    if(!$(".Fremdsprache.FPF").length)return;
    var value = $(".Fremdsprache.FPF").val();
    $(".Fremdsprache").not(".FPF").find("option[value=" + value + "]").hide().removeAttr('selected');
    $(".Fremdsprache").not(".FPF").find("option[value!=" + value + "]").show().removeAttr('selected').attr('selected','selected').trigger("chosen:updated");;
}
function onChangeNawiFach(event){
    if(!$(".Naturwissenschaft.FPF").length)return;
    var value = $(".Naturwissenschaft.FPF").val();
    $(".Naturwissenschaft").not(".Naturwissenschaft.FPF").find("option[value=" + value + "]").hide().removeAttr('selected');
    $(".Naturwissenschaft").not(".Naturwissenschaft.FPF").find("option[value!=" + value + "]").show().removeAttr('selected').attr('selected','selected').trigger("chosen:updated");;
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