<?php 
$id_Cue=$_POST['id_Cue'];
include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM cuentas WHERE id_Cue=".$id_Cue;
    $result = $con->query($sql);
    $cuenta = $result->fetch_assoc();
?>
<h1>Pagar cuenta mesa <?php echo $cuenta['NumMesa'];?></h1>
<form id="<?php echo $id_Cue; ?>" class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Detalle de la cuenta</legend>

            <?php
                include('../../php/cuenta.php');
                $orden = new orden();
                $orden -> detalleCuenta($id_Cue);
            ?> 
            <br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-usd" aria-hidden="true"></i> Pagar Cuenta</button>
        <button id="cortesia" type="submit" class="pure-button button-primary"><i class="fa fa-usd" aria-hidden="true"></i> Cortesia</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>
<script type="text/javascript">
     //---------- Boton de cancelar
     $('#cancelar').click(function(event){
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/orden.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
     //---------- Boton guardar
     $('#guardar').click(function(event){

     	event.preventDefault();
        var id_Cue=$('form').attr('id');
        var mesa="<?php echo $cuenta['NumMesa'];?>";
        
        $.ajax({ 
            data:{id_Cue:id_Cue, mesa:mesa},
            type: "POST", 
            url: 'php/ordenes/funcionPagar.php',  
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
      //---------- Boton cortesia
     $('#cortesia').click(function(event){

        event.preventDefault();
        var id_Cue=$('form').attr('id');
        var mesa="<?php echo $cuenta['NumMesa'];?>";
        
        $.ajax({ 
            data:{id_Cue:id_Cue, mesa:mesa},
            type: "POST", 
            url: 'php/ordenes/funcionCortesia.php',  
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