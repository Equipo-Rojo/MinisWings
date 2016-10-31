<?php 
$id_Cue=$_POST['id_Cue'];
include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM cuentas WHERE id_Cue=".$id_Cue;
    $result = $con->query($sql);
    $cuenta = $result->fetch_assoc();
?>
<h1>Editar cuenta mesa <?php echo $cuenta['NumMesa'];?></h1>
<form id="<?php echo $id_Cue; ?>" class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Actualizar ordenes</legend>

            <?php
                include('../../php/cuenta.php');
                $orden = new orden();
                $orden -> listarOrdenes($id_Cue);
            ?> 
            <br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>
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
   
        var id = [];
        var estado = [];
     	$("select option:selected").each(function(){
            id.push($(this).attr('name'));
            estado.push($(this).val());
        });
        var idJSON = JSON.stringify(id);
        var estadoJSON = JSON.stringify(estado);
       $.ajax({ 
        	data:{id_Ord:idJSON, estado:estadoJSON},
            type: "POST", 
            url: 'php/ordenes/funcionEditarCuenta.php',  
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