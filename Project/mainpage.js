function test(tag) {
	console.log(tag);
	console.log($(tag).children());
	// add it to cookie
}

function refine() {
	var checked = $("input:checkbox:checked");
	var get = "";
	for (var i=0; i<checked.length; i++) {
		console.log($(checked[i]).attr('id'));
		get += "refine[]=" + $(checked[i]).attr('id')+"&";
	}
	get = get.slice(0,-1);
	var here = window.location.href;
	window.location.href = here.substring(0,here.indexOf('?')) + "?" + get
}
