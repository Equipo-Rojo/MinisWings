<?php 
$id_Cue=$_POST['id_Cue'];
include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM cuentas WHERE id_Cue=".$id_Cue;
    $result = $con->query($sql);
    $cuenta = $result->fetch_assoc();
?>
<h1>Agregar orden a <?php echo $cuenta['NumMesa'];?></h1>
<form id="<?php echo $id_Cue; ?>" class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nueva Orden</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Cantidad</label>
                <input class="pure-u-1-2 form-edite" type="number" min="1" step="1" id="cantidad" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Orden</label>
                <select id="orden" class="pure-u-1-2 form-edite" name="orden" value="">
                    <option>Seleccionar...</option>
                    <?php
				        include('../../php/cuenta.php');
				        $orden= new orden();
				        $orden-> listarMenu();
				    ?>
                </select>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Comentarios</label>
                <textarea id="comentarios" class="pure-u-1-2 form-edite" name="comentarios" value=""></textarea>
            </div>

        </div>
        <br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
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
     	var tipoId=$('#orden').val();
     	var cantidad=$('#cantidad').val();
     	var id_Cue=$('form').attr('id');
        var comentarios=$('#comentarios').val();
        $.ajax({ 
        	data:{id_Cue:id_Cue, tipoID: tipoId, cantidad:cantidad, comentarios:comentarios},
            type: "POST", 
            url: 'php/ordenes/funcionNuevaOrden.php',  
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