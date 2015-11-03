$(function() {

	$('document').ready(function(){
            affich_users_client();
 	});
    
    

    $(document).on('dblclick','#list_user tr',function (){
        id_user = this.id;
        var arrayColonnes;
        var arrayColonnes = this.cells;
        nom = arrayColonnes[0].innerHTML;
        prenom = arrayColonnes[1].innerHTML;
        fonction = arrayColonnes[2].innerHTML;
        loggin = arrayColonnes[3].innerHTML;
        arrayColonnes.item(0).innerHTML = "<input name='nom_user_new' class='form-control nom_user_new' id='nom_user_new' value='"+nom+"'></input>";
        arrayColonnes.item(1).innerHTML = "<input name='prenom_user_new' class='form-control prenom_user_new' id='prenom_user_new' value='"+prenom+"'></input>";
        arrayColonnes.item(2).innerHTML = "<input name='fonction_user_new' class='form-control fonction_user_new' id='fonction_user_new' value='"+fonction+"'></input>";
        arrayColonnes.item(3).innerHTML = "<input name='loggin_user_new' class='form-control loggin_user_new' id='loggin_user_new' value='"+loggin+"'></input>";
        arrayColonnes.item(5).innerHTML = "<font size='4pt'><i style='cursor:pointer;color:#00a65a;opacity:1' class='glyphicon glyphicon-ok save_affect_collab'></i></font>";
        $('html').click(function()
        {
            arrayColonnes.item(0).innerHTML = nom;
            arrayColonnes.item(1).innerHTML = prenom;
            arrayColonnes.item(2).innerHTML = fonction;
            arrayColonnes.item(3).innerHTML = loggin;
            arrayColonnes.item(5).innerHTML = "";
        });
        $('#list_user tr').click(function(event)
        {
           event.stopPropagation();
        });
        
    });

	$(document).on('click','.save_user',function(){
            affect = this.id;
            var elem = affect.split('_');
            affect_id = elem[2];
            date_fin = document.getElementById(affect_id).value;
            $.post('forms/admin/affect/req_gest_affect_modif.php',{affect_id:affect_id,date_fin:date_fin},function(data) {
                    $('#text_success_affect').html(data);
                    $("#success_affect").modal("show");
                });
                setTimeout(function(){	
                    $("#success_affect").modal("hide");
                }, 2000);
            var id_contrat = $('#contrat_affect').val();
            affich_users_client();
            return false;
        });
        
    $(document).on('click','.save_new_user',function(){
        nom_user = document.getElementById("nom_user_new").value;
        prenom_user = document.getElementById("prenom_user_new").value;
        fonction_user = document.getElementById("fonction_user_new").value;
        loggin_user = document.getElementById("loggin_user_new").value; 
        password_user = document.getElementById("password_user_new").value; 
        $.post('forms/admin/users/req_gest_users_add.php',{nom_user:nom_user,prenom_user:prenom_user,fonction_user:fonction_user,loggin_user:loggin_user,password_user:password_user,myid:myid},function(data) {
                $('#text_success_user').html(data);
                $("#success_user").modal("show");
            });
            setTimeout(function(){  
                $("#success_user").modal("hide");
            }, 2000);
        affich_users_client();
        return false;
    });    
             
    $(document).on('click','.del-user',function (){
        $("#alert_user").modal("show");
        var user_id = this.id;
        document.getElementById('id_user_suppr').value = user_id;
        document.getElementById("text_suppr_user").innerHTML = "Etes-vous sur de vouloir supprimer l'utilisateur n°"+user_id;
    });
               
    $(document).on('click','#bt_alert_suppr_user',function(){
        var user_id = document.getElementById('id_user_suppr').value;
        $.ajax({
    	type: "POST",
            url: "forms/admin/users/req_users_del.php",
            data: "user_id="+user_id, // on envoie $_GET['go']
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $("#alert_user").modal("hide");
                $('#text_success_user').html(data);
                $("#success_user").modal("show");
            }
        });
        setTimeout(function(){	
            $("#success_user").modal("hide");
        }, 2000);
        affich_users_client();
        return false;
 	});


    function affich_users_client(){
        $.ajax({
    	type: "POST",
            url: "forms/admin/users/req_gest_users.php",
            data: "myid_client="+myid_client+"&myid="+myid, // on envoie $_GET['go']
            datatype: "html", // on veut un retour JSON
            success: function(data) {
                $('.afficher').html(data);
            }
        });
    }
        
        
    
});