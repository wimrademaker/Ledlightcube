<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('dbspul.php');

$content = '<h1>Instellingen tijdschakeling</h1>
		<p>Geef hier aan wanneer de kubussen aan en uit moeten schakelen.<br />Is de uit tijd vroeger dan de aan tijd dan betekend dat hij de volgende dag uit gaat.</p>
			<form method="post">
				<label >Van (hh:mm):</label><input type="text" name="van_tijd" value="'.$van_tijd.'"><br />
				<label >Tot (hh:mm):</label><input type="text" name="tot_tijd" value="'.$tot_tijd.'"><br />
				<input class="opslaan link" type="submit" value="Opslaan" name="submit">
			</form>';
include('template.php');
?>
