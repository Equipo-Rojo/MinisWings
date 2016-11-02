<div class="orden1">
    <h1>Ordenes pendientes</h1>
    <!--<button class="button-xlarge button-warning pure-button add-cuenta"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cuenta/Mesa</button>-->
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
    //---------- Boton de editar orden a preparando
    $('.change-preparando').click(function(event){
        
        var id_Ord=$(this).attr('id');
        
        $.ajax({
            data:{id_Ord:id_Ord}, 
            type: "POST", 
            url: 'php/ordenes/preparar-orden.php',  
            success: function(data) {  
                alertify.alert(data);
                $.ajax({ 
                    type: "POST", 
                    url: 'modulos/menu/orden.php',  
                    success: function(data) {  
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                });  
            }  
        });  
    });   
    //---------- Boton de editar orden a Listo
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
                    url: 'modulos/menu/orden.php',  
                    success: function(data) {  
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                });  
            }  
        });  
    });   
</script>