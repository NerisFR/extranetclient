<?php

    include '../../functions.php';
    $id_user = $_POST['user_id'];
    
    global $db;
    $rep = $db->query("DELETE FROM user_client WHERE user_client.id = ".$id_user);
    $rep->closeCursor();

    echo "<div>";
    echo "<span>L'utilisateur n°".$id_user." a bien été supprimé.</span>";
    echo "</div>";

?>
  