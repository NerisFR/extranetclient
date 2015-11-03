<?php

    $db = new PDO('mysql:host=neris_extranet.mysql.db;dbname=neris_extranet;charset=utf8', 'neris_extranet', 'fc2YUH9xMku9');
    $data = array();
    
    $clientid = $_POST['client_id'];
    $req = "SELECT contrats.id, contrats.description FROM (clients INNER JOIN contrats ON clients.id = contrats.id_client) WHERE ((clients.id)='$clientid'); " or die (mysql_error());
    $cli = $db->query($req);

    // $contrats = $cli->fetch(PDO::FETCH_ASSOC);
    // $dbConnect = null;

    while($donnees = $cli->fetch(PDO::FETCH_OBJ)) {
        $currentid = "$donnees->id";
        $currentvalue = "$donnees->description";
        $data[] =     array('index'=>$currentid,'value'=>$currentvalue);
            };
  echo json_encode($data);
  
?>