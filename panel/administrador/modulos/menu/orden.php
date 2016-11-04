<div class="orden1">
    <h1>Ordenes</h1>
    <button class="button-xlarge  pure-button add-cuenta"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cuenta/Mesa</button>
    <br/><br/>
    <div id="panel-cuentas">
         <?php
            include('../../php/cuenta.php');
            $pla = new orden();
            $pla -> listarCuentas();
        ?>
    </div>
</div>
<script type="text/javascript">
     //---------- Boton de agregar cuenta
    $('.add-cuenta').click(function(event){
        $.ajax({ 
            type: "POST", 
            url: 'php/ordenes/add-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });
    //---------- Boton de agregar orden
    $('.add-orden').click(function(event){
        
        var id_cue=$(this).attr('id');

        $.ajax({
            data:{id_Cue:id_cue}, 
            type: "POST", 
            url: 'php/ordenes/add-orden.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });
    //---------- Boton de pagar cuenta
    $('.pay-cuenta').click(function(event){
        var id_cue=$(this).attr('id');
        $.ajax({ 
            data:{id_Cue:id_cue}, 
            type: "POST", 
            url: 'php/ordenes/pay-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        }); 
    });
    //---------- Boton de editar cuenta
    $('.edite-cuenta').click(function(event){
        
        var id_cue=$(this).attr('id');

        $.ajax({
            data:{id_Cue:id_cue}, 
            type: "POST", 
            url: 'php/ordenes/editar-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>