<div class="orden1">
    <h1>Ordenes</h1>
    <button class="button-xlarge button-warning pure-button add-cuenta"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cuenta/Mesa</button>
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
     //---------- Boton de agregar producto al platillo
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
     $('.pay-cuenta').click(function(event){
        alertify.alert("click pagar");
       /* $.ajax({ 
            type: "POST", 
            url: 'php/ordenes/add-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        }); */ 
    });   
</script>