// remove every non-numeric instance of a character from the text input given
// by the "id" parameter
function OnlyNumbers(id) {
	return function() {
		//console.log($(id).val());
		var num = $(id).val();
		$(id).val(num.replace(/\D/g,''));
	}
}
$(window).on("load", function() {
	$("#cc").bind("input",OnlyNumbers("#cc"));
	$("#cvc").bind("input",OnlyNumbers("#cvc"));
});
