<?php
    session_start();
    require("../../../auth.php");
    if(Auth::isLogged()){
      
    }
    else{
      header('Location:forms/404.php');
    }

  include '../../functions.php';
  global $db;

	// $sql = "SELECT id, nom_usage FROM collaborateurs ORDER BY nom_usage";
	// $sth = $db->query($sql);
 //  $list_collab = $sth->fetchall();

  $myid = $_SESSION['auth']['id_client'];

  $sql = "SELECT DISTINCT contrats.id, contrats.description FROM (clients INNER JOIN contrats ON clients.id = contrats.id_client) INNER JOIN (collaborateurs INNER JOIN affect_cont_collab ON collaborateurs.id = affect_cont_collab.id_collab) ON contrats.id = affect_cont_collab.id_contrat WHERE (((clients.id)='$myid'))";
  $stcont = $db->query($sql);
  $list_cont = $stcont->fetchall();
?>

<!-- DATA TABLES -->
<link href="./plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

    <div class="box box-primary" id="zone-hour">
        <div class="box-header with-border">
            <h3 class="box-title">Paramètres</h3><i class="pull-right fa fa-fw fa-chevron-down" style="cursor:Pointer;text-align: right;" id="icon-hour"/>
        </div><!-- /.box-header -->
    <!--</div> /.box-header -->
<!--    <form role="form" action="#" class="consultNDS" id="consultNDS">-->
    <div class="box-body"  id="table-hour">
        <form role="form" action="#" class="consultNDS" id="consultNDS">
        <div class="form-group">
            <div class="row">
                <div class="col-xs-3">Contrat :</div>
                <div class="col-xs-3">
                    <select name="contrat" id="contrat" class="contrat" > 
                      <option value="0" selected='selected'> </option>
                      <?php
                            $myid = $_SESSION['auth']['myid'];
                            global $list_cont;
                            foreach($list_cont as $row){
                              echo "<option value=$row[0]>$row[1]</option>";
                            }
                          ?>
                    </select>
                </div>
                <div class="col-xs-3">Année :</div>
                <div class="col-xs-3">
                    <select name="annee" id="annee" class="annee" style="width:195px"> 
                        <option> </option>
                    </select>
                </div>
            </div>    
        </div>
        <div  class="col-xs-offset-5 col-xs-2 text-center">
            <a type="button" class="btn btn-block btn-primary" id="bt_affich">Afficher</a>
        </div>
        </form>
    </div>
    </div>

<br></br>

<div class="afficher"></div> <!-- /.Affichage du contenu -->

<script type="text/javascript" src="./forms/tdb/hour/ctrl_tdb_heures.js"></script>
