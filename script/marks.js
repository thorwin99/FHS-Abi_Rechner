$(document).ready(function(){

	$("#marksForm").submit(function(event){
        checkEmpty(event);
        event.preventDefault();
	});
});
function checkEmpty(event){
    $("input[type=number]").each(function(){
        if(isNaN($(this).val())){
            alert("Du kannst nur Zahlen als noten eingeben.");   
        }
    });
});