<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('dbspul.php');

//Laad de nieuwe settings
$result = $db->query("SELECT 
							*							
						FROM 
							patronen_metadata
						ORDER BY gemaakt_op DESC	
						");
$patronen = $result->fetchAll(PDO::FETCH_ASSOC);


$content = '<h1>Selecteer een nieuw patroon voor de schoorsteen</h1>
		<p>Een nieuw geselecteerd patroon wordt geladen wanneer het bestaande patroon is afgelopen.</p>';

$content .= '<table class="select_tabel">';
$content .= '<tr>';
$content .= '<th>Naam</th>';
$content .= '<th>Gemaakt door</th>';
$content .= '<th>Datum gemaakt</th>';	
$content .= '<th>Omschrijving</th>';
$content .= '<th>&nbsp;</th>';
$content .= '</tr>';

foreach($patronen as $patroon){
	$content .= '<tr>';
	$content .= '<td>'.$patroon['patroon_naam'].'</td>';
	$content .= '<td>'.$patroon['gemaakt_door'].'</td>';
	$content .= '<td>'.$patroon['gemaakt_op'].'</td>';	
	$content .= '<td>'.$patroon['omschrijving'].'</td>';
	$content .= '<td><a class="link" href="?laad_lib='.$patroon['id_patronen'].'">selecteer</a></td>';	
	$content .= '</tr>';
}


$content .= '</table>';
		
include('template.php');
?>
