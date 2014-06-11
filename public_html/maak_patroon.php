<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db_maak_patroon.php');

$content = '<h1>Maak een nieuw patroon voor de schoorsteen</h1>';
$content .= '<div id="container_selectie" class="clear">
</br>
</br>
	<div id="container_kubus1" class="container_kubus">
		<div class="kubus_benaming">Bovenste kubus</div></br>
		<ul>
			<li class="frame key" style="background-color: rgb(0, 0, 0);" data-r="0" data-g="0" data-b="0">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="addframes link">+</li>
		</ul>
	</div>
	<div id="container_kubus2" class="container_kubus">
		<div class="kubus_benaming">Middelste kubus</div></br>
		<ul>
			<li class="frame key" style="background-color: rgb(0, 0, 0);" data-r="0" data-g="0" data-b="0">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="addframes link">+</li>
		</ul>
	</div>
	<div id="container_kubus3" class="container_kubus">
		<div class="kubus_benaming">Onderste kubus</div></br>
		<ul>
			<li class="frame key" style="background-color: rgb(0, 0, 0);" data-r="0" data-g="0" data-b="0">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="frame">&nbsp;</li><li class="addframes link">+</li>
		</ul>
	</div>
</div>	
<div id="popup">
	<div id="popup-line"></div>
	<div id="picker"></div>
	<div  class="knop link right" id="picker_delete_key">Delete key</div>
	<div   class="knop link right" id="picker_cancel">Cancel</div>
	<div  class="knop link right" id="picker_save_key">save</div>
</div>';

$content .= '<div id="uitleg">
<ul class="uitleg">
<li>Maak je eigen patroon door hierboven per kubus de kleuren aan te geven</li>
<li>Pas de kleur aan door op de kubus te klikken</li>
<li>Bij de kleur zwart is de kubus uit</li>
<li>De tijd dat het patroon duurt wordt bepaald door het aantal gebrukte vakjes keer de hieronder ingestelde tijd.</li>
<li>Je patroon duurt totdat de laatste kleur is bereikt, hou daarvoor de lengte van iedere kubus gelijk.</li>
<li>Selecteer je gemaakte patroon bij <a href="/selecteer_patroon.php">Selecteer een patroon</a></li>
</ul>
<hr>
<form method="post" name="maakpatroon" id="maakpatroon">
	<input type="hidden" name="patroon" id="patroon" value="" />
	<label >Tijd van 1 blokje is (in seconden) :</label><input type="text" name="tijdseenheid" value="1"></br>
	<label >Je naam:</label><input type="text" name="naam_maker" value="" placeholder="Je naam hier"></br>
	<label >Naam van je patroon:</label><input type="text" name="naam_patroon" value="" placeholder="Naam van het patroon hier"></br>

	<input class="opslaan link" type="submit" value="Opslaan" name="submit">
</form>
</div>';
		
$content .='</div>';
include('template.php');
?>
