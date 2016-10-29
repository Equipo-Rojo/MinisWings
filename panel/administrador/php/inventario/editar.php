<?php
    $id=$_POST['id'];
    include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM inventario WHERE id_Inv=".$id;
    $result = $con->query($sql);
    $producto = $result->fetch_assoc();
?>
<h1>Editar Inventario</h1>
<form class="pure-form pure-form-stacked" name="edit_inventario" method="POST">
    <fieldset>
        <legend>Producto: <?php echo $producto['nombre']; ?></legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del producto</label>
                <input id="nom" class="pure-u-1-2 form-edite" type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="des" class="pure-u-1-2 form-edite" type="text" name="descripcion" value="" required ><?php echo $producto['descripcion']; ?></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Unidad de medida</label>
                <input id="med" class="pure-u-1-2 form-edite" type="text" name="medida" value="<?php echo $producto['medida']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Cantidad en existencia</label>
                <input id="can" class="pure-u-1-2 form-edite" type="number" name="cantidad" step="1" min="0" value="<?php echo $producto['cantidad']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Existencia minima</label>
                <input id=min" class="pure-u-1-2 form-edite"  type="number" name="minimo" step="1" min="0" value="<?php echo $producto['minimo']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="sta" class="pure-u-1-2 form-edite" name="status" value="">
                    <option>Seleccionar...</option>
                    <option<?php if($producto['status']=="inactivo"){echo "selected";} ?> name="sta" value="inactivo">Inactivo</option>
                    <option <?php if($producto['status']=="activo"){echo "selected";} ?> name="sta" value="activo" >Activo</option>
                </select>
            </div>
        </div>
        <br/><br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>

<script type="text/javascript">
    //---------- Boton de eliminar producto del inventario
    $('#guardar').click(function(event){
        event.preventDefault();
        var valido=1;
        var datos=[];
        var id=<?php echo $id; ?>;
        $( ".form-edite" ).each(function(){
            if($(this).val()=="" || $(this).val()=="Seleccionar..."){valido=0;}
            
            datos.push(' '+$(this).attr('name')+'="'+$(this).val()+'"');
        });

        if(valido==1){

            var datosJSON = JSON.stringify(datos);
            $.ajax({ 
                data : {datos:datosJSON, id:id},
                type: "POST", 
                url: 'php/inventario/funcionEditar.php',  
                success: function(data) {
                    $.ajax({ 
                        type: "POST", 
                        url: data,  
                        success: function(data) {
                            $("div#main").empty();
                            $("div#main").append(data);
                        }  
                    });  
                }  
            });  
        }
        else{
            alert("Faltan campos");
        }
    }); 
    //---------- Boton de cancelar edicion de producto del inventario
     $('#cancelar').click(function(event){
        event.preventDefault();
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/inventario.php',  
            success: function(data) {
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
        
    });   
</script>