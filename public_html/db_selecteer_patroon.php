<?php
$config['db_path'] = $_SERVER['DOCUMENT_ROOT']."/../database/kubus";
$db = new PDO("sqlite:".$config['db_path']);

//Laad alle patronen
$result = $db->query("SELECT 
							*							
						FROM 
							patronen_metadata
						ORDER BY gemaakt_op DESC	
						");
						
$patronen = $result->fetchAll(PDO::FETCH_ASSOC);


if(isset($_GET['laad_lib'])){
	//pwm out 	0..4095
	//rgb  		0..255
	$sql = "SELECT * FROM patronen WHERE id_patronen_metadata = " . (int)$_GET['laad_lib'] . " ORDER BY id_patronen";
	$result = $db->query($sql);
	$patroon_regels = $result->fetchAll(PDO::FETCH_ASSOC);

	//Maak de oude tabel leeg (droppen in sqlite)
	$sql = "DROP TABLE IF EXISTS patroon_actief";
	$db->query($sql);
	
	//Bouw de nieuwe tabel op
	$sql = 'CREATE TABLE patroon_actief ("id_patroon_geladen" INTEGER PRIMARY KEY AUTOINCREMENT,	"kubus1_van_r" INTEGER,	"kubus1_van_g" INTEGER, "kubus1_van_b" INTEGER, "kubus1_naar_r" INTEGER, "kubus1_naar_g" INTEGER, "kubus1_naar_b" INTEGER, "kubus2_van_r" INTEGER, "kubus2_van_g" INTEGER, "kubus2_van_b" INTEGER, "kubus2_naar_r" INTEGER, "kubus2_naar_g" INTEGER, "kubus2_naar_b" INTEGER, "kubus3_van_r" INTEGER, "kubus3_van_g" INTEGER, "kubus3_van_b" INTEGER, "kubus3_naar_r" INTEGER, "kubus3_naar_g" INTEGER, "kubus3_naar_b" INTEGER, "tijd" INTEGER)';
	$db->query($sql);
	
	$vorige_patroon_regel = "";
	
	//Vul de table met het geselecteerde patroon
	foreach($patroon_regels as $patroon_regel){
		if($vorige_patroon_regel == ""){
			$vorige_patroon_regel = $patroon_regel;
		}else{
			//Bereken de transitie tijd
			$tijd = ($patroon_regel['key_veld'] - $vorige_patroon_regel['key_veld']) * $patroon_regel['tijd'];
			
			//De sql
			$sql = "INSERT INTO patroon_actief (
					kubus1_van_r,
					kubus1_van_g,
					kubus1_van_b,
					kubus1_naar_r,
					kubus1_naar_g,
					kubus1_naar_b,
					kubus2_van_r,
					kubus2_van_g,
					kubus2_van_b,
					kubus2_naar_r,
					kubus2_naar_g,
					kubus2_naar_b,    
					kubus3_van_r,
					kubus3_van_g,
					kubus3_van_b,
					kubus3_naar_r,
					kubus3_naar_g,
					kubus3_naar_b,
					tijd
			) VALUES (
				'".$vorige_patroon_regel['k1_r']."',
				'".$vorige_patroon_regel['k1_g']."',
				'".$vorige_patroon_regel['k1_b']."',
				'".$patroon_regel['k1_r']."',
				'".$patroon_regel['k1_g']."',
				'".$patroon_regel['k1_b']."',				
				'".$vorige_patroon_regel['k2_r']."',
				'".$vorige_patroon_regel['k2_g']."',
				'".$vorige_patroon_regel['k2_b']."',
				'".$patroon_regel['k2_r']."',
				'".$patroon_regel['k2_g']."',
				'".$patroon_regel['k2_b']."',				
				'".$vorige_patroon_regel['k3_r']."',
				'".$vorige_patroon_regel['k3_g']."',
				'".$vorige_patroon_regel['k3_b']."',
				'".$patroon_regel['k3_r']."',
				'".$patroon_regel['k3_g']."',
				'".$patroon_regel['k3_b']."',
				'".$tijd."'
			)";
			$db->query($sql);
			
			//Bewaar deze regel als oude data
			$vorige_patroon_regel = $patroon_regel;
		}
		
	}	
	
}
