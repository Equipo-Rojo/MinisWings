<?php

?>
<h1>Agregar empleado</h1>
<form class="pure-form pure-form-stacked" name="edit_empleado" method="POST">
    <fieldset>
        <legend>Nuevo empleado</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nickname</label>
                <input class="pure-u-1-2 form-add" type="text" name="nickname" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del empleado</label>
                <input class="pure-u-1-2 form-add" type="text" name="Nombre" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Apellido</label>
                <input class="pure-u-1-2 form-add" type="text" name="Apellido" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Roll</label>
                <input class="pure-u-1-2 form-add" type="text" name="Rol" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="sta" class="pure-u-1-2 form-add" name="Estado" value="">
                    <option>Seleccionar...</option>
                    <option name="Estadp" value="inactivo">Inactivo</option>
                    <option name="Estado" value="activo" >Activo</option>
                </select>
            </div>
            
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Contraseña</label>
                <input class="pure-u-1-2 form-add" type="password" name="Contraseña" value="" required>
            </div>
        </div>
        <br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>

<script type="text/javascript">

    //---------- Boton de eliminar empleado del empleado
    $('#guardar').click(function(event){
        event.preventDefault();
        var valido=1;
        var datos=[];
        var campos=[];
        $( ".form-add" ).each(function(){
            if($(this).val()=="" || $(this).val()=="Seleccionar..."){valido=0;}
            campos.push($(this).attr('name'));
            datos.push('"'+$(this).val()+'"');
        });

        if(valido==1){
            var datosJSON = JSON.stringify(datos);
            var camposJSON = JSON.stringify(campos);
            $.ajax({ 
                data : {datos:datosJSON, campos:camposJSON},
                type: "POST", 
                url: 'php/empleado/funcionAgregar.php',  
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
           alertify.alert("Faltan campos");
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
</script>