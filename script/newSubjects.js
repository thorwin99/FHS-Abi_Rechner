var FSubjectCountSum = 0;
$(document).ready(isReady);
function isReady(){
    $("#subjectForm").submit(formSubmit);
    $(".CountField").change(onChangeCountNumber);
    $(".Fremdsprache").change(onChangeFremdSprache);
}
function formSubmit(event){
    var nullSubjects = [];
    var sumOfSubjects = 0;
    $(".CountField").each(function(){
        var value = Number($(this).val());
        sumOfSubjects += value;
        nullSubjects.push($(this).parent().parent());
    });
    if(sumOfSubjects != 3){
        alert("Du musst 3 Fächer auswählen!");
        event.preventDefault();
    }else{
        for(i = 0; i < nullSubjects.length; i++){
            nullSubjects[i].remove();
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
function onChangeFremdSprache(event){
    var value = $(this).val();
    switch(value){
        case "Englisch"://Wenn Englisch gewählt wird
            $(".Fremdsprache").not("#FPF").find("option[value=Englisch]").hide();
            $(".Fremdsprache").not("#FPF").find("option[value!=Englisch]").show();
            break;
        default://Wenn Spanisch/Französisch gewählt wird
            $(".Fremdsprache").not("#FPF").find("option[value!=Englisch]").hide();
            $(".Fremdsprache").not("#FPF").find("option[value=Englisch]").show();
            break;  
    }
}
function getSubjectCountSum(){
    var sumOfSubjects = 0;
    $(".CountField").each(function(){
        var value = Number($(this).val());
        sumOfSubjects += value;
    });
    return sumOfSubjects;
}