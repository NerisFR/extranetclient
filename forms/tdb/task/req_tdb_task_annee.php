<?php
	setlocale(LC_TIME, "fr_FR");
    $db = new PDO('mysql:host=neris_extranet.mysql.db;dbname=neris_extranet;charset=utf8', 'neris_extranet', 'fc2YUH9xMku9');
	$contratid = $_POST['contrat_id'];
	$annees = array();
	$sql="SELECT contrats.demarrage FROM contrats WHERE contrats.id='".$contratid."'";
	$date_dem = $db->query($sql);
	$dem = $date_dem->fetch();
	$demarrage = $dem[0];
	$annee_dem = intval(date("Y", strtotime($demarrage)));
	$mois_dem = intval(date("m", strtotime($demarrage)));

	$mois_courant = intval(date("m"));

	
	if($mois_dem == 1){
		$j=0;
		for($i=date("Y");$i>=$annee_dem;$i--){
			$annees[$j]=$i;

			$j++;
		}
	}
	elseif($mois_dem > $mois_courant){
		$j=0;
		for($i=date("Y");$i>$annee_dem;$i--){
			$annees[$j]=($i-1)." - ".$i;
			$j++;
		}
	}
	else {
		$j=0;
		for($i=date("Y");$i>$annee_dem-1;$i--){
			$annees[$j]=$i." - ".($i+1);
			$j++;
		}
	}
echo json_encode($annees);
?>
