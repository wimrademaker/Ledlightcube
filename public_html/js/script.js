$(document).ready(function(){

	var ww = $(window).width();
	var mw = $('#menu').outerWidth();
	var csub = parseInt($('#content').css('marginLeft')) + parseInt($('#content').css('marginRight'));
	$('#content').width((ww-mw-csub)+'px');
	
	//colorpicker instellen
	$('#picker').colpick({
		flat:true,
		layout:'rgbhex',
		submit: false,
		onChange:function(hsb,hex,rgb) {
			//Set de rgb kleuren voor het geselecteerde frame
			var f = $('.frame_selected');
			f.css('background-color','rgb('+rgb.r+','+rgb.g+','+rgb.b+')');
			f.addClass('key');
			f.attr('data-r', rgb.r);
			f.attr('data-g', rgb.g);
			f.attr('data-b', rgb.b);
		}
	});
	
	
	function tussenKleuren(parent, key1, key2){
		var n_k1 = key1.index();
		var n_k2 = key2.index();
		var deelfactor = n_k2 - n_k1 - 1;

		console.log(key1);
		console.log(key1.data());
		console.log(key2.data());
		console.log('#########');
						
		var kleur_k1 = key1.data();
		var kleur_k2 = key2.data();
		
		//Bereken wat de offset per stap moet zijn per kleur
		var offset = kleuroffset(kleur_k1, kleur_k2, deelfactor);

		//Herbereken de tussenstappen voor de vlakken tussen de vorige en het actieve vlak
		setkleuren(parent, key1, offset, deelfactor);
	}	
	
	
	function kleuroffset(k1, k2, n){
		var r = [];
		r['r'] = (k2.r - k1.r) / n
		r['g'] = (k2.g - k1.g) / n 
		r['b'] = (k2.b - k1.b) / n
		
		return r
	}
	
	
	function setkleuren(p, k1, offset, n){
		var kleur1 = k1.data();
console.log(kleur1);
		//Start frame index
		var pi = k1.index()+2;		
				
		for ( var i = 0; i < n; i++ ) {
			console.log('loop: '+i)

			kleur1.r += offset.r;
			kleur1.g += offset.g;
			kleur1.b += offset.b;

			console.log(kleur1);		
			var k = p.find("div:nth-child(" + (pi+i) + ")");
			console.log(k)
			k.data('r', Math.round (kleur1.r))
			k.data('g', Math.round (kleur1.g))
			k.data('b', Math.round (kleur1.b))
			k.css('background-color', 'rgb('+Math.round (kleur1.r)+','+Math.round (kleur1.g)+','+Math.round (kleur1.b)+')');
		}
	}



	var product = {
		'+': function(a, b){return a+b},
		'-': function(a, b){return a-b},
		}

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
		//Haal de parent div op en het key frame voor, deze en erna
		var f = $('.frame_selected');
		var parent = f.parent('.container_kubus');
		var key1 = f.prevAll("div.key:first");
		var key2 = f;
		var key3 = f.nextAll("div.key:first");

		//Als er een key hiervoor bestaat dan bereken de tussenkleuren
		if(key1.size() > 0){
			tussenKleuren(parent, key1, key2);
		}

		if($('.frame_selected').css("background-color") != "transparent"){
			$('.frame_selected').addClass('key');
		}
		$(".frame").removeClass('frame_selected');
		$('#popup').css('display', 'none');
	})
})


