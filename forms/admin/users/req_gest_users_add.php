<?php

    include '../../functions.php';
    $nom_user = $_POST['nom_user'];
    $prenom_user = $_POST['prenom_user'];
    $fonction_user = $_POST['fonction_user'];
    $loggin_user = $_POST['loggin_user'];
    $password_user = md5($_POST['password_user']);
    $id_client = $_POST['myid'];
    global $db;
    $rep = $db->query("INSERT INTO user_client(id, nom, prenom, fonction, loggin, password, id_client) VALUES ('','$nom_user','$prenom_user','$fonction_user','$loggin_user','$password_user','$id_client')");
    
    $rep->closeCursor();

    echo "<div>";
    echo "<span>La nouvelle affectation a bien été enregistré.</span>";
    echo "</div>";

?>
  