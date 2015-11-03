<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    $myid = $_POST['myid_client'];
    $monid = $_POST['myid'];
    include '../../functions.php';
    global $db;

        $list_users = $db->query("SELECT user_client.id, user_client.nom, user_client.prenom, user_client.fonction, user_client.loggin, user_client.password FROM (user_client INNER JOIN clients ON clients.id = user_client.id_client) WHERE (((clients.id)=".$myid."))");
        $users = $list_users->fetchall();
        $list_users->closeCursor();

?>


    <div class='row'>
    <div class='col-xs-12'>
    <div class='box'>
    <div class='box-header'>
    <h3 class='box-title'>Liste des affectations par collaborateur</h3>
    </div>
    <div class='box-body table-responsive'>
    <table id='list_user' class='table table-bordered dt-responsive table-striped table-hover display nowrap'>
    <thead>
    <tr>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Fonction</th>
    <th>Loggin</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th style="text-align:center"><font size='4pt'><i id='add-affect' onclick='add_line()' style='cursor:pointer;color:#3c8dbc' class='glyphicon glyphicon-plus-sign'></i></font></th>
    </tr>
    </thead>
    <tbody>
    
    
<?php
    foreach ($users as $user) {
        echo "<tr id='$user[0]' title='Double-clic pour ouvrir'>";
        echo "<td>".$user[1]."</td>";
        echo "<td>".$user[2]."</td>";
        echo "<td>".$user[3]."</td>";
        echo "<td>".$user[4]."</td>";
        echo "<td>&nbsp;</td>";
        echo "<td><font size='4pt'><i id='save_user_$user[0]' style='color:#00a65a;opacity:0' class='glyphicon glyphicon-ok save_affect save_user_$user[0]'></i></font></td>";
        if ($user[0] == $monid){
            echo "<td><font size='4pt'><i id='$user[0]' style='cursor:Pointer;opacity:0' class='glyphicon glyphicon-trash del-user' id='del-user'></i></font></td>";
        }
        else{
            echo "<td><font size='4pt'><i id='$user[0]' style='cursor:Pointer' class='glyphicon glyphicon-trash del-user' id='del-user'></i></font></td>";
        }
        echo "</tr>";
    };
?>
    
    
    
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>

<script type="text/javascript">

    $('#list_user').DataTable({
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
                                header.text()+':'+
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
            sSwfPath: "./plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
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
        info: true,
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [4, 5, 6]
        }]
    });

        
    
    function add_line(){
        var arrayLignes = document.getElementById("list_user").rows; //l'array est stocké dans une variable
        var longueur = arrayLignes.length;//Recherche de la longueur de tableau
        var ligne = document.getElementById("list_user").insertRow(1);
        /*var colonne1 = ligne.insertCell(0);
        colonne1.innerHTML = "&nbsp;";*/
        var colonne2 = ligne.insertCell(0);
        colonne2.innerHTML = "<input name='nom_user_new' class='form-control nom_user_new' style='width:250px' id='nom_user_new'></input>";
        var colonne3 = ligne.insertCell(1);
        colonne3.innerHTML = "<input name='prenom_user_new' class='form-control prenom_user_new' style='width:250px' id='prenom_user_new'></input>";
        var colonne4 = ligne.insertCell(2);
        colonne4.innerHTML = "<input name='fonction_user_new' class='form-control fonction_user_new' style='width:100px'  id='fonction_user_new'></input>";
        var colonne5 = ligne.insertCell(3);
        colonne5.innerHTML = "<input name='loggin_user_new' class='form-control loggin_user_new' style='width:100px'  id='loggin_user_new'></input>";
        var colonne6 = ligne.insertCell(4);
        colonne6.innerHTML = "<input name='password_user_new' class='form-control password_user_new' style='width:100px'  id='password_user_new' placeholder='Password'></input>";
        var colonne7 = ligne.insertCell(5);
        colonne7.innerHTML = "<font size='4pt'><i style='cursor:pointer;color:#00a65a;opacity:1' class='glyphicon glyphicon-ok save_new_user'></i></font>";

    }

    
</script>