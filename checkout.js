// remove every non-numeric instance of a character from the text input given
// by the "id" parameter
function OnlyNumbers(id) {
	return function() {
		console.log($(id).val());
		var num = $(id).val();
		$(id).val(num.replace(/\D/g,''));
	}
}
$(window).on("load", function() {
	$("#cc").bind("input",OnlyNumbers("#cc"));
	$("#cvc").bind("input",OnlyNumbers("#cvc"));
	for (var i=1; i<=12; i++) {
		$("#expireMonth").append("<option value="+i+">"+(i<10?"0"+i:i)+"</option>");;
	}
	for (var i=2017; i<=2040; i++) {
		$("#expireYear").append("<option value="+i+">"+i+"</option>");
	}
});
