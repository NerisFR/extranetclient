$(document).ready(function(){

    // if (myadmin==0){
    //     document.getElementById('collab').disabled = 'false';
    //     document.getElementById('collab').disabled = 'true';
    // };

    $(document).on('change','.collab',function (){
        var collab_id = $('.collab').val();
        var list_client
        $.ajax({
            type: "POST",
                url: "forms/nds/consult/req_cli.php",
                data: "collab_id="+ collab_id, // on envoie $_GET['go']
                datatype: "json", // on veut un retour JSON
                success: function(data) {
                    $('.client').empty();
                    var list_client = $.parseJSON(data);
                    nb = 0;
                    $.each($.parseJSON(data), function(index, value) {
                    $('.client').append('<option value="'+ list_client[nb].index +'">'+ list_client[nb].value +'</option>');
                    nb++;
                    });
                }
        });
    });

    $(document).on('change','.client',function (){
        var collab_id = $('.collab').val();
        var client_id = $('.client').val();
        var list_contrat
        $.ajax({
            type: "POST",
                url: "forms/nds/consult/req_contrats.php",
                data: "collab_id="+ collab_id+"&client_id="+client_id, // on envoie $_GET['go']
                datatype: "json", // on veut un retour JSON
                success: function(data) {
                    $('.contrat').empty();
                    $('.contrat').empty();
                    var list_contrat = $.parseJSON(data);
                    nb = 0;
                    $('.contrat').append('<option selected></option>');
                    $.each($.parseJSON(data), function(index, value) {
                    $('.contrat').append('<option value="'+ list_contrat[nb].index +'">'+ list_contrat[nb].value +'</option>');
                    nb++;
                    });
                }
        });
    });

    $(document).on('change','.contrat',function (){
        var contrat_id = $('.contrat').val();
        var list_annee;
        $.ajax({
            type: "POST",
            url: "forms/tdb/hour/req_tdb_heures_annee.php",
            data: "&contrat_id="+contrat_id, // on envoie $_GET['go']
            datatype: "json", // on veut un retour JSON
            success: function(data) {
                $('.annee').empty();
                var list_annee = $.parseJSON(data);
                nb = 0;
                $.each($.parseJSON(data), function(value) {
                    $('.annee').append('<option>'+ list_annee[nb] +'</option>');
                    nb++;
                });
            }
        });
    });
   
    $(document).on('click','#bt_affich',function (){
        var collab_id = $('.collab').val();
        var client_id = $('.client').val();
        var contrat_id = $('.contrat').val();
        var annees = $('.annee').val();
        $.ajax({
            type: "POST",
            url: "forms/tdb/hour/req_tdb_heures.php",
            data: "collab_id="+collab_id+"&client_id="+client_id+"&contrat_id="+contrat_id+"&annees="+annees, // on envoie $_GET['go']
            datatype: "html", // on veut un retour HTML
            success: function(data) {
                $('.afficher').html(data);
                $('#icon-hour').removeClass('fa-chevron-down');
                $('#icon-hour').addClass('fa-chevron-up');
                $('#table-hour').addClass('hide');
                $('#table-bilan-hour').addClass('hide');
                $('#icon-bilan-hour').removeClass('fa-chevron-down');
                $('#icon-bilan-hour').addClass('fa-chevron-up');
            }
        });
        
        
    });

    $(document).on('click','#icon-hour',function (){
    	$('#icon-hour').toggleClass('fa-chevron-down');
        $('#icon-hour').toggleClass('fa-chevron-up');
        $('#table-hour').toggleClass("hide");
        $('#table-hour').toggleClass("show");
    });
    
    $(document).on('click','#icon-bilan-hour',function (){
    	$('#icon-bilan-hour').toggleClass('fa-chevron-down');
        $('#icon-bilan-hour').toggleClass('fa-chevron-up');
        $('#table-bilan-hour').toggleClass("hide");
        $('#table-bilan-hour').toggleClass("show");
    });
});

