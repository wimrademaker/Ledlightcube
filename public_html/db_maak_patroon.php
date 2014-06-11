<?
$config['db_path'] = "/var/www/schoorsteen/database/kubus";
$db = new PDO("sqlite:".$config['db_path']);

if(isset($_POST['patroon']) && $_POST['patroon'] != ''){
	//Insert de metadata in de db;
	$sql = "INSERT INTO patronen_metadata (
				patroon_naam, 
				gemaakt_door, 
				gemaakt_op
			) VALUES (
				'".str_replace( "'", "''", $_POST['naam_patroon'])."',
				'".str_replace( "'", "''", $_POST['naam_maker'])."',
				'".date('d-m-Y')."'
			)";
	$db->query($sql);
	$patroon_id = $db->lastInsertId();
	
	//Haal de id van de metadata op
	$patronen = json_decode($_POST['patroon']);
	
	$keys = array_keys((array)$patronen->kubus1);
	print_r($keys);
	foreach($keys as $key){
		$sql = "INSERT INTO patronen (
					id_patronen_metadata,
					k1_r, 
					k1_g, 
					k1_b, 
					k2_r, 
					k2_g, 
					k2_b, 
					k3_r, 
					k3_g, 
					k3_b, 
					key_veld,
					tijd
			) VALUES (
				'".$patroon_id."',
				'".$patronen->kubus1->$key->r."',
				'".$patronen->kubus1->$key->g."',
				'".$patronen->kubus1->$key->b."',
				'".$patronen->kubus2->$key->r."',
				'".$patronen->kubus2->$key->g."',
				'".$patronen->kubus2->$key->b."',
				'".$patronen->kubus3->$key->r."',
				'".$patronen->kubus3->$key->g."',
				'".$patronen->kubus3->$key->b."',
				'".$key."',
				'".str_replace( "'", "''", $_POST['tijdseenheid'])."'
				
			)";
		$db->query($sql);
		header("location:/maak_patroon.php");
	}
}

//Laad de nieuwe settings
//$result = $db->query("SELECT 
//							*
//						FROM 
//							instellingen
//						WHERE id_instellingen = 1	
//						");
//$instellingen = $result->fetchAll(PDO::FETCH_ASSOC);
//$instelling = $instellingen[0];	


