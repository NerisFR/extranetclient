<?php
    session_start();
    require("../../../auth.php");
    if(Auth::isLogged()){

    }
    else{
            header('Location:forms/404.php');
    }
    // include '../../functions.php';
    // global $db;

    // $today = date("Y-m-d");
    // $sql = "SELECT id, nom_usage FROM collaborateurs  ORDER BY nom_usage ";
    // $sth = $db->query($sql);
    // $list_collab = $sth->fetchall();
    
    // $sql = "SELECT id, nom FROM clients ORDER BY nom";
    // $sth = $db->query($sql);
    // $list_cli = $sth->fetchall();

    // $myid = $_SESSION['auth']['id_client'];

    // $sql = "SELECT id, description FROM contrats ORDER BY description";
    // $str = $db->query($sql);
    // $list_cont = $str->fetchall();
?>
<!-- DATA TABLES -->
<link href="./plugins/datatables/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />
<link href="./plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

<div class="box box-primary" id="test">
    <div class="box-header with-border">
      <h3 class="col-xs-6 box-title">Gestions des affectations</h3>
<!--      <h3 class="col-xs-6 box-title add" id="btn-add" style="text-align: right;cursor:Pointer"><i class='glyphicon-plus'></i>Ajouter</h3>-->
    </div><!-- /.box-header -->
</div>




<div class="afficher container-fluid">
    
</div>

<div class="modal fade" id="alert_user" tabindex="-1" role="dialog">
    <div class="modal-danger">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            
            <h4 class="modal-title">Attention</h4>
          </div>
          <div class="modal-body">
            <p id="text_suppr_user">One fine body&hellip;</p>
            <span style='opacity:0'><input id="id_user_suppr"></input></span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" id="bt_alert_annul_user">Annuler</button>
            <button type="button" class="btn btn-outline" id="bt_alert_suppr_user">Suppr.</button>
          </div>
        </div> 
      </div>
    </div>  
  </div> 

<div class="modal fade" id="success_user" tabindex="-1" role="dialog">
    <div class="modal-success">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span >&times;</span></button>
            
            <h4 class="modal-title">Opération réussie</h4>
          </div>
          <div class="modal-body">
            <p id="text_success_user">One fine body&hellip;</p>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-right" data-dismiss="modal" id="bt_success_user">Ok</button>
<!--            <button type="button" class="btn btn-outline" id="bt_alert_suppr">Suppr.</button>-->
          </div>
        </div>  
      </div>  
    </div>  
</div> 

<script type="text/javascript" src="./forms/admin/users/ctrl_gest_users.js"></script>
