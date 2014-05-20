$(document).ready(function(){

	var ww = $(window).width();
	var mw = $('#menu').outerWidth();
	var csub = parseInt($('#content').css('marginLeft')) + parseInt($('#content').css('marginRight'));
	$('#content').width((ww-mw-csub)+'px');
})
