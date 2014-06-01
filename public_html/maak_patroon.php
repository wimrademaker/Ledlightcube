<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('dbspul.php');

$content = '<h1>Maak een nieuw patroon voor de schoorsteen</h1>
		<p>Bouw je eigen patroon zodat je hem kunt laden in de schoorsteen</p>';
$content = '<div id="container_selectie">
	<div id="container_kubus1" class="container_kubus">
		Onder
		<div class="frame key" style="background-color: rgb(0, 0, 0);" data-r="0" data-g="0" data-b="0"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>	
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>				
	</div>
	<div id="container_kubus2" class="container_kubus">
		Midden
		<div class="frame key" style="background-color: rgb(0, 0, 0);" data-r="0" data-g="0" data-b="0"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>	
	</div>
	<div id="container_kubus3" class="container_kubus">
		Boven
		<div class="frame key" style="background-color: rgb(0, 0, 0);" data-r="0" data-g="0" data-b="0"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>
		<div class="frame"></div>	
	</div>
</div>
<div id="popup"><div id="popup-line"></div><div id="popup-close">X</div>colorpicker<hr><div id="picker"></div></div></div>';


include('template.php');
?>
