<h1>Agregar Cuenta</h1>
<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nueva Cuenta</legend>

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Número de mesa</label>
                <select id="mesa" class="pure-u-1-2 form-edite" name="mesa" value="">
                    <option>Seleccionar...</option>
                    <?php
				        include('../../php/cuenta.php');
				        $pla = new orden();
				        $pla -> listarMesas();
				    ?>
                </select>
            </div>

            <!--<div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estatus</label>
                <select id="status" class="pure-u-1-2 form-edite" name="status" value="">
                    <option>Seleccionar...</option>
                    <option name="status" value="Abierta">Abierta</option>
                    <option name="status" value="Cerrada">Cerrada</option>
                </select>
            </div>-->
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
     	var mesa=$('#mesa').val();

        $.ajax({ 
        	data:{mesa:mesa},
            type: "POST", 
            url: 'php/ordenes/funcionNuevaCuenta.php',  
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