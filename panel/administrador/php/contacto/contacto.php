<?php
    include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM contactos ";
    $result = $con->query($sql);
    $contacto = $result->fetch_assoc();
?>
<div class="General">
    
<h1>Editar Contacto</h1>
<form class="pure-form pure-form-stacked" name="edit_inventario" method="POST">
    <fieldset>
        <legend>Datos de contacto</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre de contacto</label>
                <input id="nom" class="pure-u-1-2 form-edite" type="text" name="nombre" value="<?php echo $contacto['nombre']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Dirección</label>
                <textarea id="des" class="pure-u-1-2 form-edite" type="text" name="direccion" value="" required ><?php echo $contacto['direccion']; ?></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Facebook</label>
                <input id="med" class="pure-u-1-2 form-edite" type="text" name="facebook" value="<?php echo $contacto['facebook']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Télefono</label>
                <input id="can" class="pure-u-1-2 form-edite" type="text"  name="telefono" value="<?php echo $contacto['telefono']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Celular</label>
                <input id=min" class="pure-u-1-2 form-edite"  type="text" name="celular" value="<?php echo $contacto['celular']; ?>" required>
            </div>
        </div>
        <br/><br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>
    
</div>

<script type="text/javascript">
    //---------- Boton de eliminar producto del inventario
    $('#guardar').click(function(event){
        event.preventDefault();
        var valido=1;
        var datos=[];
        $( ".form-edite" ).each(function(){
            if($(this).val()=="" || $(this).val()=="Seleccionar..."){valido=0;}
            
            datos.push(' '+$(this).attr('name')+'="'+$(this).val()+'"');
        });

        if(valido==1){
            var datosJSON = JSON.stringify(datos);
            $.ajax({ 
                data : {datos:datosJSON},
                type: "POST", 
                url: 'php/contacto/funcionEditar.php',  
                success: function(data) {
                    $.ajax({ 
                        type: "POST", 
                        url: 'modulos/menu/page.php',  
                        success: function(data) {
                            $("div#main").empty();
                            $("div#main").append(data);
                        }   
                    });  
                }  
            });  
        }
        else{
            alertify.alert("Faltan campos");
        }
    }); 
    //---------- Boton de cancelar edicion de producto del inventario
     $('#cancelar').click(function(event){
        event.preventDefault();
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/page.php',  
            success: function(data) {
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
        
    });   
</script>
