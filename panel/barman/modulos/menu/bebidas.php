<div class="orden1">
    <h1>Ordenes pendientes</h1>
    <!--<button class="button-xlarge button-warning pure-button add-cuenta"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cuenta/Mesa</button>-->
    <br/><br/>
    <div id="panel-cuentas">
         <?php
            include('../../php/bebida.php');
            $pla = new orden();
            $pla -> listarCuentas();
        ?>
    </div>
</div>
<script type="text/javascript">
    //---------- Boton de preparar cuenta
    $('.change-preparar').click(function(event){
        
        var id_Ord=$(this).attr('id');
        
        $.ajax({
            data:{id_Ord:id_Ord}, 
            type: "POST", 
            url: 'php/ordenes/preparar-orden.php',  
            success: function(data) {  
                alertify.alert(data);
                $.ajax({ 
                    type: "POST", 
                    url: 'modulos/menu/bebidas.php',  
                    success: function(data) {  
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                });  
            }  
        });  
    });   
    //---------- Boton de terminar
    $('.change-listo').click(function(event){
        
        var id_Ord=$(this).attr('id');
        
        $.ajax({
            data:{id_Ord:id_Ord}, 
            type: "POST", 
            url: 'php/ordenes/terminar-orden.php',  
            success: function(data) {  
                alertify.alert(data);
                $.ajax({ 
                    type: "POST", 
                    url: 'modulos/menu/bebidas.php',  
                    success: function(data) {  
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                });  
            }  
        });  
    });   
</script>