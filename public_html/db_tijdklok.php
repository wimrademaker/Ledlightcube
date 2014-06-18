<?php
$config['db_path'] = $_SERVER['DOCUMENT_ROOT']."/../database/kubus";
$db = new PDO("sqlite:".$config['db_path']);

if(isset($_POST['van_tijd']) && isset($_POST['tot_tijd']) && $_POST['van_tijd'] != '' && $_POST['tot_tijd'] != '' ){
	$aan = substr($_POST['van_tijd'], 0, 2) . '-' . substr($_POST['van_tijd'], 3, 2) . '-00' ;
	$uit = substr($_POST['tot_tijd'], 0, 2) . '-' . substr($_POST['tot_tijd'], 3, 2) . '-00' ;
	
	$sql = "UPDATE instellingen SET tijd_aan = '".$aan."', tijd_uit = '".$uit."' WHERE id_instellingen = 1";
	$result = $db->query($sql);
	//if($result){
	//	echo 'Update ok';
	//}else{
	//	echo 'Update NOK: <br>';
	//	print_r($db->errorInfo());
	//}
}

//Laad de nieuwe settings
$result = $db->query("SELECT 
							*
						FROM 
							instellingen
						WHERE id_instellingen = 1	
						");
$instellingen = $result->fetchAll(PDO::FETCH_ASSOC);
$instelling = $instellingen[0];	

$van_tijd = str_replace('-', ':', substr($instelling['tijd_aan'],0, 5));
$tot_tijd = str_replace('-', ':', substr($instelling['tijd_uit'],0 ,5));
