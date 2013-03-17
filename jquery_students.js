$(document).ready (function() {
$('div#mod').css("display","none");

$('input[value="Add"]').on("click", function(){
$('div#mod').css("display","inline");
$('input[name="flag"]').val(0);
})

$('input[value="Edit"]').on("click", function(){
$('div#mod').css("display","inline");
$('input[name="flag"]').val(1);
})

});