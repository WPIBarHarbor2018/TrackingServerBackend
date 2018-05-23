window.onresize = resizeBlurredBackgrounds;

$(function () {
	resizeBlurredBackgrounds();
});

function resizeBlurredBackgrounds(){
	var w = $(window).width();

	$('#side_bar_bg').width(w);
}
