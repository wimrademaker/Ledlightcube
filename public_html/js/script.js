$(document).ready(function(){

	var ww = $(window).width();
	var mw = $('#menu').outerWidth();
	var csub = parseInt($('#content').css('marginLeft')) + parseInt($('#content').css('marginRight'));
	$('#content').width((ww-mw-csub)+'px');
	
	//colorpicker enabelen
	$('#picker').colpick({
		flat:true,
		layout:'rgbhex',
		submit: false,
		onChange:function(hsb,hex,rgb) {
		var f = $('.frame_selected');
		f.css('background-color','rgb('+rgb.r+','+rgb.g+','+rgb.b+')');
		f.addClass('key');
		f.attr('data-r', rgb.r);
		f.attr('data-g', rgb.g);
		f.attr('data-b', rgb.b);
		var i1 = f.prevAll("div.key:first").index();
		var ia = f.index();
		var i2 = f.nextAll("div.key:first").index();
 		var p = f.parent('.container_kubus');

console.log(p.find("div:nth-child(" + i1 + ")").attr('data-r'));
console.log(f.prevAll("div.key:first").index());
console.log(f.nextAll("div.key:first").index());
	}
	});
	

	//Content frame op breedte maken
	$('.frame').click(function(){
		var top = $(this).offset().top - 65;
		var left = $(this).offset().left - 272;
		
		$('#popup').css('left', left+'px');
		$('#popup').css('top', top+'px');
		$('#popup').css('display', 'block');
		$(this).addClass('frame_selected');
	});
	
	//Popup box met colorpicker sluiten
	$('#popup-close').click(function(){
		if($('.frame_selected').css("background-color") != "transparent"){
			$('.frame_selected').addClass('key');
		}
		$(".frame").removeClass('frame_selected');
		$('#popup').css('display', 'none');
	})
})


