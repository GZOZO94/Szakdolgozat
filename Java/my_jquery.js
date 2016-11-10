$(document).ready(function(){
	$("li").mouseover(function(){
		$(this).addClass("active");
	});
	$("li").mouseleave(function(){
		$(this).removeClass("active")
	});
});

