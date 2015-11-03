<?php
    session_start();
    setlocale(LC_TIME, "fr_FR");
    $db = new PDO('mysql:host=neris_extranet.mysql.db;dbname=neris_extranet;charset=utf8', 'neris_extranet', 'fc2YUH9xMku9');
    $NDS = array();
    $clientid = $_POST['client_id'];
    $contratid = $_POST['contrat_id'];
    $datedeb = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['date_debut'])));
    $datefin = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['date_fin'])));
    $typeheure = $_POST['type_heure'];
    if($contratid==0){
        $req = "SELECT nds.id as id, nds.jour as jour, clients.nom as client, nds.arrivee as arrivee, nds.depart as depart, nds.tps_total as tps_total, nds.commentaire as commentaire, nds.type_heure as type_heure, contrats.description as description, collaborateurs.id, collaborateurs.nom_usage FROM clients INNER JOIN (contrats INNER JOIN (collaborateurs INNER JOIN (affect_cont_collab INNER JOIN nds ON affect_cont_collab.id = nds.id_affect) ON collaborateurs.id = affect_cont_collab.id_collab) ON contrats.id = affect_cont_collab.id_contrat) ON clients.id = contrats.id_client WHERE  ((nds.Jour) BETWEEN '".$datedeb."' AND '".$datefin."') AND (nds.type_heure='".$typeheure."') AND (clients.id='".$clientid."') ORDER BY jour DESC;" or die (mysql_error());
    }
    else{
        $req = "SELECT nds.id as id, nds.jour as jour, clients.nom as client, nds.arrivee as arrivee, nds.depart as depart, nds.tps_total as tps_total, nds.commentaire as commentaire, nds.type_heure as type_heure, contrats.description as description, collaborateurs.id, collaborateurs.nom_usage FROM clients INNER JOIN (contrats INNER JOIN (collaborateurs INNER JOIN (affect_cont_collab INNER JOIN nds ON affect_cont_collab.id = nds.id_affect) ON collaborateurs.id = affect_cont_collab.id_collab) ON contrats.id = affect_cont_collab.id_contrat) ON clients.id = contrats.id_client WHERE  ((nds.Jour) BETWEEN '".$datedeb."' AND '".$datefin."') AND (nds.type_heure='".$typeheure."') AND (clients.id='".$clientid."') AND (contrats.id='".$contratid."') ORDER BY jour DESC;" or die (mysql_error());
    }
    $cli = $db->query($req);
    $NDS = $cli->fetchall();
    
    // $today = new DateTime('2010/01/01');
    
?>


        <div class='row'>
        <div class='col-xs-12'>
        <div class='box'>
        <div class='box-header'>
            <h3 class='box-title pull-left'>Liste des notes de synthèse</h3>
<!--         <h3><abbr title='Télécharger la vue'><i id='download_nds' style='cursor:pointer;color:#3c8dbc' class='glyphicon glyphicon-cloud-download pull-right'></i></abbr></h3>
 -->    </div>
        <div class='box-body'>
        <table id='listNDS' class='table display' cellspacing="0" width="100%">
        <thead>
        <tr>
        <th style='text-align:center'>Date</th>
        <th style='text-align:center'>Collab.</th>
        <th style='text-align:center'>Client</th>
        <th style='text-align:center'>Contrat</th>
        <th style='text-align:center'>Type d'heure</th>
        <th style='text-align:center'>Arrivée</th>
        <th style='text-align:center'>Départ</th>
        <th style='text-align:center'>Tps</th>
        <th>Commentaire</th>
        </tr>
        </thead>
        <tbody>

<?php
    setlocale(LC_TIME, "fr_FR");
    foreach ($NDS as $row) {
        echo "<tr id='$row[0]' title='Double-clic pour ouvrir'>";
        $compar = new datetime($row[1]);
        echo "<td>".date("d/m/Y", strtotime($row[1]))."</td>";
        echo "<td style='disabled:true'>".$row[10]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>".$row[8]."</td>";
        echo "<td>".$row[7]."</td>";
        echo "<td>".$row[3]."</td>";
        echo "<td>".$row[4]."</td>";
        echo "<td>".$row[5]."</td>";
        echo "<td style='text-overflow:ellipsis'>".$row[6]."</td>";
        echo "</tr>";
    };
?>
</tbody>
</table>
</div>
</div>
</div>
</div>





<script type='text/javascript'>
      $(function () {
        /*$.extend( $.fn.dataTable.defaults, {
            responsive: true
        } );*/

        $('#listNDS2').DataTable({
            
            
        });
        $('#listNDS2 tbody').on('click', 'tr', function () {
            var id = this.id;
            var index = $.inArray(id, selected);
     
            if ( index === -1 ) {
                selected.push( id );
            } else {
                selected.splice( index, 1 );
            }
     
            $(this).toggleClass('selected');
        } );
      
        $('#listNDS').DataTable({
            language: {
                lengthMenu: "_MENU_ résutats par page",
                zeroRecords: "Aucun résultat - Désolé",
                info: "page _PAGE_ sur _PAGES_",
                infoEmpty: "Aucun enregistrement",
                infoFiltered: "(filtrage sur un total de _MAX_ enregistrement)",
                search: "Recherche"
            },
            responsive: {
                details: {
                    renderer: function ( api, rowIdx ) {
                    // Select hidden columns for the given row
                    var data = api.cells( rowIdx, ':hidden' ).eq(0).map( function ( cell ) {
                        var header = $( api.column( cell.column ).header() );
 
                        return '<tr>'+
                                '<td>'+
                                    header.text()+' : '+
                                '</td> '+
                                '<td>'+
                                    api.cell( cell ).data()+
                                '</td>'+
                            '</tr>';
                    } ).toArray().join('');
 
                    return data ?
                        $('<table/>').append( data ) :
                        false;
                    }
                }
            },
            
            dom: '<"row"<"col-xs-4"l><"col-xs-4"f><"col-xs-4"<"pull-right"T>>><t>ip',
            /*'dom': 'TBfrtip',*/
            tableTools: {
                sSwfPath: "./swf/copy_csv_xls_pdf.swf",
                aButtons: [
                   /* "copy",
                    "print",*/
                    {
                        sExtends:    "collection",
                        sButtonText: "Enregistrer",
                        aButtons:    [ "csv", "xls", "pdf" ]
                    }
                ]
            },
            
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tout"]],
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true
            
        });
        $('#listNDS tbody').on('click', 'tr', function () {
            var id = this.id;
            var index = $.inArray(id, selected);
     
            if ( index === -1 ) {
                selected.push( id );
            } else {
                selected.splice( index, 1 );
            }

            $(this).toggleClass('selected');
        } );
      });
</script>




  