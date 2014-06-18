$(document).ready(function(){

	var ww = $(window).width();
	var mw = $('#menu').outerWidth();
	var csub = parseInt($('#content').css('marginLeft')) + parseInt($('#content').css('marginRight'));
	var startkleur = '';
	var h_menu = $('#menu').outerHeight();
	var h_content = $('#content').outerHeight();
	
	$('#content').width((ww-mw-csub)+'px');
	
	if(h_content > h_menu){
		$('#menu').height(parseInt(h_content)+10+'px');
	}


	$('.addframes').click(function(){
		for ( var i = 0; i < 20; i++ ) {
			$('<li class="frame">&nbsp;</li>').insertBefore('.addframes');
		}
		var pos = $(this).position();
		 $("#container_selectie").animate({scrollLeft: (pos.left + 300)}, 800);
	});
	
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
		}
	});
	
	
	//Content frame op breedte maken
	$( ".container_kubus" ).on( "click", ".frame", function(){
		var top = $(this).offset().top - 65;
		var left = $(this).offset().left - 630;
		startkleur = $(this).css('background-color');
		$('#popup').css('left', left+'px');
		$('#popup').css('top', top+'px');
		$('#popup').css('display', 'block');
		$(this).addClass('frame_selected');
	});
	
	//Popup box met colorpicker opslaan sluiten
	$('#picker_save_key').click(function(){
		//Haal de parent li op en het key frame voor, deze en erna
		var f = $('.frame_selected');
		var parent = f.parents('.container_kubus');
		var key1 = f.prevAll("li.key:first");
		var key2 = f;
		var key3 = f.nextAll("li.key:first");

		//Als er een key hiervoor bestaat dan bereken de tussenkleuren
		if(key1.size() > 0){
			tussenKleuren(parent, key1, key2);
		}
		//Als er een key hierna bestaat dan bereken de tussenkleuren
		if(key3.size() > 0){
			tussenKleuren(parent, key2, key3);
		}

		if($('.frame_selected').css("background-color") != "transparent"){
			$('.frame_selected').addClass('key');
		}
		$(".frame").removeClass('frame_selected');
		$('#popup').css('display', 'none');
	})
	
	
	//Haal de key van het geselecteerde frame
	$('#picker_delete_key').click(function(){
		var f = $('.frame_selected');
		var parent = f.parents('.container_kubus');
		var key1 = f.prevAll("li.key:first");
		var key3 = f.nextAll("li.key:first");

		//Als er een key hiervoor bestaat dan bereken de tussenkleuren
		if(key3.size() > 0){
			tussenKleuren(parent, key1, key3);
		}else{
			tussenKleuren(parent, key1, key1);	
		}
		
		$('.frame_selected').removeClass('key');

		$(".frame").removeClass('frame_selected');
		$('#popup').css('display', 'none');
	})
	
	//Popup box met colorpicker sluiten
	$('#picker_cancel').click(function(){
		var f = $('.frame_selected');

		$('.frame_selected').css("background-color", startkleur);
		$('.frame_selected').removeClass('key');
		$(".frame").removeClass('frame_selected');
		$('#popup').css('display', 'none');
	})
	
	$('#maakpatroon').submit(function(){
		//Verzamel de gebruikte key indexes
		var keys = {};
		$( "li.key" ).each(function( index ) {
			keys["'key_" + $(this).index() + "'"] = $(this).index() 
		});

		//Voor iedere index moet nu de kleur per kubus opgehaald worden 
		var patronen = {};
		patronen['kubus1'] = keywaardes_per_kubus('container_kubus1', keys);
		patronen['kubus2'] = keywaardes_per_kubus('container_kubus2', keys);
		patronen['kubus3'] = keywaardes_per_kubus('container_kubus3', keys);

		//Maak een json string en sla hem op in het hidden field.
		var json = JSON.stringify(patronen);
		$('#patroon').val(json);
	});
})


	function keywaardes_per_kubus(kubus, keys){
		var r = {}
		//Haal van ieder key frame de rgb waardes op
		$.each( keys, function( key, val ){	
			r[val] = getkleur($('#'+kubus+' ul li:nth-child('+(val+1)+')'));
		});	
		
		return r;
	}

	function tussenKleuren(parent, key1, key2){
		var n_k1 = key1.index();
		var n_k2 = key2.index();
		var deelfactor = n_k2 - n_k1 - 1;
	
		var kleur_k1 = getkleur(key1);
		var kleur_k2 = getkleur(key2);
		
		//Bereken wat de offset per stap moet zijn per kleur
		var offset = kleuroffset(kleur_k1, kleur_k2, deelfactor);

		//Herbereken de tussenstappen voor de vlakken tussen de vorige en het actieve vlak
		setkleuren(parent, key1, offset, deelfactor);
	}	
	
	function getkleur(key){
		//Haal de r, g en b kleuren appart op.
		var rgb = key.css('background-color');
		var rgb_val = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/); 
		var r = {}
		r['r'] = parseInt(rgb_val[1])
		r['g'] = parseInt(rgb_val[2])
		r['b'] = parseInt(rgb_val[3])
		return r
	}
	
	function kleuroffset(k1, k2, n){
		//Bereken wat de offset is van iedere kleur
		var r = [];
		r['r'] = (k2.r - k1.r) / n
		r['g'] = (k2.g - k1.g) / n 
		r['b'] = (k2.b - k1.b) / n
		
		return r
	}
	
	
	function setkleuren(p, k1, offset, n){
		var kleur1 = getkleur(k1);

		//Start frame index
		var pi = k1.index()+1;		
		
		//Bereken iedere nieuwe kleur		
		for ( var i = 0; i < n; i++ ) {
			kleur1.r += offset.r;
			kleur1.g += offset.g;
			kleur1.b += offset.b;
			
			//Schrijf de nieuw berekende kleur naar het frame
			p.find("li").eq(pi+i).css('background-color', 'rgb('+Math.round (kleur1.r)+','+Math.round (kleur1.g)+','+Math.round (kleur1.b)+')');
		}
	}
