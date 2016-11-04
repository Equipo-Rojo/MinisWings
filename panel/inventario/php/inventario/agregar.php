<h1>Agregar a  Inventario</h1>
<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nuevo Producto</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del producto</label>
                <input id="nom" class="pure-u-1-2 form-edite" type="text" name="nombre" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="des" class="pure-u-1-2 form-edite" type="text" name="descripcion" value="" required ></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Unidad de medida</label>
                <input id="med" class="pure-u-1-2 form-edite" type="text" name="medida" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Cantidad en existencia</label>
                <input id="can" class="pure-u-1-2 form-edite" type="number" name="cantidad" step="1" min="0" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Existencia minima</label>
                <input id=min" class="pure-u-1-2 form-edite"  type="number" name="minimo" step="1" min="0" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="sta" class="pure-u-1-2 form-edite" name="status" value="">
                    <option>Seleccionar...</option>
                    <option name="sta" value="inactivo">Inactivo</option>
                    <option name="sta" value="activo" >Activo</option>
                </select>
            </div>
        </div>
        <br/><br/>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>
<script type="text/javascript">
    //---------- Boton de cancelar agregar producto del inventario
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
    //---------- Boton de eliminar producto del inventario
    $('#guardar').click(function(event){
        event.preventDefault();
        var valido=1;
        var datos=[];
        var campos=[];
        $( ".form-edite" ).each(function(){
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
                url: 'php/inventario/funcionAgregar.php',  
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
     
</script>