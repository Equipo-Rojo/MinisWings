<?php
    $id=$_POST['id'];
    include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM empleado WHERE id_Em=".$id;
    $result = $con->query($sql);
    $empleado = $result->fetch_assoc();
?>
<h1>Editar empleado</h1>
<form class="pure-form pure-form-stacked" name="edit_empleado" method="POST">
    <fieldset>
        <legend>empleado: <?php echo $empleado['Nombre']." ".$empleado['Apellido']; ?></legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nickname</label>
                <input class="pure-u-1-2 form-edite" type="text" name="nickname" value="<?php echo $empleado['nickname']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del empleado</label>
                <input class="pure-u-1-2 form-edite" type="text" name="Nombre" value="<?php echo $empleado['Nombre']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Apellido</label>
                <input class="pure-u-1-2 form-edite" type="text" name="Apellido" value="<?php echo $empleado['Apellido']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Roll</label>
                <input class="pure-u-1-2 form-edite" type="text" name="Rol" value="<?php echo $empleado['Rol']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="sta" class="pure-u-1-2 form-edite" name="Estado" value="">
                    <option>Seleccionar...</option>
                    <option<?php if($empleado['Estado']=="inactivo"){echo "selected";} ?> name="Estadp" value="inactivo">Inactivo</option>
                    <option <?php if($empleado['Estado']=="activo"){echo "selected";} ?> name="Estado" value="activo" >Activo</option>
                </select>
            </div>
        </div>
        <br/><br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button id="reset" type="submit" class="pure-button button-warning"><i class="fa fa-refresh" aria-hidden="true"></i> Restaurar contraseña</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>

<script type="text/javascript">
    //---------- Boton de eliminar empleado del empleado
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
                url: 'php/empleado/funcionEditar.php',  
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
            alertify.myAlert("Faltan campos");
        }
    }); 
    //---------- Boton de cancelar edicion de empleado 
    $('#cancelar').click(function(event){
        event.preventDefault();
        $.ajax({ 
            type: "POST", 
            url: 'modulos/menu/empleados.php',  
            success: function(data) {
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });        
    });
    //---------- Boton de resert password de empleado 
    $('#reset').click(function(event){
        event.preventDefault();
        var id=<?php echo $id; ?>;
        var roll='<?php echo $empleado['Rol']; ?>';
        $.ajax({ 
            data : {id:id, roll: roll},
            type: "POST", 
            url: 'php/empleado/reset.php',  
            success: function(data) { 
                alertify.alert("Se reinició la contraseña");
                $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/empleados.php',  
                success: function(data) {  
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
                });
            }  
        });  
    });
   
</script>