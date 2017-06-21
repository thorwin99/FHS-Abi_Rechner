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
    }
    
    function onChangeNawiFach(event){
        console.log("change");
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
}