<style type="text/css">.thumb-image{float:right;width:100px;position:relative;padding:none;}</style>
<h1>Editar Promoción</h1>
<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nueva Promo</legend>

        <div id="wrapper" style="margin-top: 20px;">
            <input id="fileUpload" class="form-add-Promo" name="url" multiple="multiple" type="file"/> 
            <div id="image-holder"></div>
        </div> 

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre de Promoción</label>
                <input id="nom" class="pure-u-1-2 form-add-Promo" type="text" name="nombre" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Categoria</label>
                <input id="cat" class="pure-u-1-2 form-add-Promo" type="text" name="categoria" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Precio</label>
                <input id="pre" class="pure-u-1-2 form-add-Promo" type="number" name="precio" value="" required >
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="des" class="pure-u-1-2 form-add-Promo" type="text" name="descripcion" value="" required ></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Estado</label>
                <select id="sta" class="pure-u-1-2 form-add-Promo" name="" value="">
                    <option>Seleccionar...</option>
                    <option name="sta" value="inactivo">Inactivo</option>
                    <option name="sta" value="activo" >Activo</option>
                </select>
            </div>
        </div>
        <legend>Ingredientes</legend>
        <div id="Promo" class="pure-g">
            <?php
                include('../Promo.php');
                $ing = new Promo();
                $ing -> listarCombo(1);
            ?>
        </div>
        <button id="agregar" type="button" class="pure-button button-warning"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Ingrediente</button>
        <button id="borrar" type="button" class="pure-button button-warning"><i class="fa fa-minus-circle" aria-hidden="true"></i> Borrar último Ingrediente</button>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>
<script>
    $(document).ready(function() {
        var ing = 2;
        $("#fileUpload").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alertify.alert("Este navegador no soporta FileReader.");
            }
          } else {
            alertify.alert("Por favor seleccione solo imagenes.");
          }
        });
        //---------- Boton de cancelar Promo
        $('#cancelar').click(function(event){
            event.preventDefault();
            $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/Promo.php',  
                success: function(data) {
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
            });    
        });
        //---------- Boton de agregar ingrediente
        $('#agregar').click(function(event){
            event.preventDefault();
            ing++;
            $.ajax({ 
                data:{num:ing},
                type: "POST", 
                url: 'php/Promo/ingrediente.php',  
                success: function(data) {
                    $("#Promo").append(data);
                }  
            });  
        });  
        //---------- Boton de borrar ingrediente
        $('#borrar').click(function(event){
            event.preventDefault();
            $("#Promo"+ing).remove();
            ing--;   
        });  
        //---------- Boton de guardar Promo
        $('#guardar').click(function(event){
            event.preventDefault();
            var valido=1;
            var datosPromo=[];
            var camposPromo=[];
            var datosIngrediente=[];
            var camposIngrediente=[];
            $( ".form-add-Promo" ).each(function(){
                if($(this).val()=="" ||  $(this).val()=="Seleccionar..."){valido=0;}
                camposPromo.push($(this).attr('name'));
                datosPromo.push('"'+$(this).val()+'"');
                
            });
            $( ".form-add-ingrediente" ).each(function(){
                if($(this).val()=="" || $(this).val()=="Seleccionar..."){valido=0;}
                camposIngrediente.push($(this).attr('name'));
                datosIngrediente.push('"'+$(this).val()+'"');
                
            });

            if(valido==1){
                var datosPromoJSON = JSON.stringify(datosPromo);
                var camposPromoJSON = JSON.stringify(camposPromo);
                var datosIngredienteJSON = JSON.stringify(datosIngrediente);
                var camposIngredienteJSON = JSON.stringify(camposIngrediente);
                $.ajax({ 
                    data : {datosPromo:datosPromoJSON, camposPromo:camposPromoJSON, datosIngrediente: datosIngredienteJSON, camposIngrediente: camposIngredienteJSON},
                    type: "POST", 
                    url: 'php/Promo/funcionAgregar.php',  
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
    });     
</script>