var FSubjectCountSum = 0;
$(document).ready(isReady);
function isReady(){
    onChangeFremdsprachFach();
    onChangeNawiFach();
    $("form").submit(formSubmit);
    $(".CountField").change(onChangeCountNumber);
    $(".Fremdsprache[id=FPF]").change(onChangeFremdsprachFach);
    $(".Naturwissenschaft[id=FPF]").change(onChangeNawiFach);
}
function formSubmit(event){
    var nullSubjects = [];
    var Subjects = [];
    var sumOfSubjects = 0;
    $(".CountField").each(function(){
        var value = Number($(this).val());
        sumOfSubjects += value;
        if(value == 0){
            nullSubjects.push($(this).parent().parent());
        }else{
            Subjects.push($(this).parent().parent());
        }
    });
    if(sumOfSubjects != 3){//Kann nicht absenden.
        alert("Du musst 3 Fächer auswählen!");
        event.preventDefault();
    }else{//Kann absenden
        for(i = 0; i < nullSubjects.length; i++){//Entferne alle Fächer mit 0 Noten eingebracht.
            nullSubjects[i].remove();
        }
        for(i = 0; i < Subjects.length; i++){
            Subjects[i].find("td[class=subjectLabel]").html();
            
        }
    }
    
}
function onChangeCountNumber(event){
    var newValue = Number($(this).val());
    FSubjectCountSum = getSubjectCountSum();
    var max = (FSubjectCountSum >= 2) ? 3-FSubjectCountSum : 2;
    $(".CountField").each(function(){
        var currentFieldValue = Number($(this).val());
        if(!(currentFieldValue > max)){
            $(this).attr("max", max);
        }
        
    });
}
function onChangeFremdsprachFach(event){
    if(!$(".Fremdsprache[id=FPF]").length)return;
    var value = $(".Fremdsprache[id=FPF]").val();
    if(value == "Englisch"){
        $(".Fremdsprache").not("#FPF").find("option[value=Englisch]").hide().removeAttr('selected');
        $(".Fremdsprache").not("#FPF").find("option[value!=Englisch]").show().removeAttr('selected').attr('selected','selected');
    }else{
        $(".Fremdsprache").not("#FPF").find("option[value!=Englisch]").hide().removeAttr('selected');
        $(".Fremdsprache").not("#FPF").find("option[value=Englisch]").show().removeAttr('selected').attr('selected','selected');
    }
}
function onChangeNawiFach(event){
    if(!$(".Naturwissenschaft[id=FPF]").length)return;
    var value = $(".Naturwissenschaft[id=FPF]").val();
    $(".Naturwissenschaft").not(".Naturwissenschaft[id=FPF]").find("option[value=" + value + "]").hide().removeAttr('selected');
    $(".Naturwissenschaft").not(".Naturwissenschaft[id=FPF]").find("option[value!=" + value + "]").show().removeAttr('selected').attr('selected','selected');
}
function getSubjectCountSum(){
    var sumOfSubjects = 0;
    $(".CountField").each(function(){
        var value = Number($(this).val());
        sumOfSubjects += value;
    });
    return sumOfSubjects;
}
function checkDoubles(){
    
    var classFs = $(".Fremdsprache");
    if(classFs[0].val() == classFS[1].val()){
        return true;
    }
    var classFsNawi = $(".Naturwissenschaft");
    if(classNawi[0].val() == classNawi[1].val()){
        return true;
    }
}