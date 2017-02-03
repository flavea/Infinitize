$(document).ready(function(){
	

	if(window.location.hash) {
		var string = '#navigation a[href="' + window.location.hash + '"]';
		$(string).addClass("clicked");
	} else {
		$("#navigation a:first-child").addClass("clicked");
	}

	$("#navigation a").click(function() {
		$("#navigation a").removeClass("clicked");
		$(this).addClass("clicked");
	});

})