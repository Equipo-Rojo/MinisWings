<style type="text/css">.thumb-image{float:right;width:100px;position:relative;padding:none;}</style>
<h1>Agregar platillo</h1>
<div id="Agregar-platillo"><form id="Agregar-platillo-Form" class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nuevo platillo</legend>

        <div id="wrapper" style="margin-top: 20px;">
            <input id="fileUpload" class="form-add-platillo button-secondary pure-button" name="url" multiple="multiple" type="file"/> 
            <div id="image-holder"></div>
        </div> 

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del platillo</label>
                <input id="nom" class="pure-u-1-2 form-add-platillo" type="text" name="nombre" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Precio</label>
                <input id="pre" class="pure-u-1-2 form-add-platillo" type="number" name="precio" value="" min="1" required >
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="des" class="pure-u-1-2 form-add-platillo" type="text" name="descripcion" value="" required ></textarea>
            </div>

             <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Categoria</label>
                <select  class="pure-u-1-2 form-add-platillo"  name="categoria" >
                    <option name="categoria" >Seleccionar...</option>
                    <option name="categoria" >Bebidas</option>
                    <option name="categoria" >Apetizers</option>
                    <option name="categoria" >Chicken</option>
                    <option name="categoria" >Burgers</option>
                </select>
            </div>

        </div>
        <legend>Ingredientes</legend>
        <div id="platillo" class="pure-g">
            <?php
                include('../platillo.php');
                $ing = new platillo();
                $ing -> listarIngrediente(1);
            ?>
        </div>
        <button id="agregar" type="button" class="pure-button "><i class="fa fa-plus" aria-hidden="true"></i> Agregar Ingrediente</button>
        <button id="borrar" type="button" class="pure-button button-secondary"><i class="fa fa-minus-circle" aria-hidden="true"></i> Borrar último Ingrediente</button>
        <button id="guardar" type="submit" class="pure-button button-warning"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <button id="cancelar" type="reset" class="pure-button button-error"><i class="fa fa fa-ban" aria-hidden="true"></i> Cancelar</button>
    </fieldset>
</form>
<script>
    $(document).ready(function() {
        var ing = 1;
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
            $('input#fileUpload').value="";
            alertify.alert("Por favor seleccione solo imagenes.");
          }
        });
        //---------- Boton de cancelar platillo
        $('#cancelar').click(function(event){
            event.preventDefault();
            $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/platillo.php',  
                success: function(data) {
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
            });    
        });
        //---------- Boton de agregar Ingrediente
        $('#agregar').click(function(event){
            event.preventDefault();
            ing++;
            $.ajax({ 
                data:{num:ing},
                type: "POST", 
                url: 'php/platillo/Ingrediente.php',  
                success: function(data) {
                    $("#platillo").append(data);
                }  
            });  
        });  
        //---------- Boton de borrar Ingrediente
        $('#borrar').click(function(event){
            event.preventDefault();
            $("#platillo"+ing).remove();
            ing--;   
        });  
        //---------- Boton de guardar platillo
        $('#guardar').click(function(event){
            event.preventDefault();

            var valido=1; // 1 = campos completos: 0 = faltan campos de llenar

            // aqui se valida que todos los campos esten llenos
            $( ".form-add-platillo" ).each(function(){
                if($(this).val()=="" ||  $(this).val()=="Seleccionar..."){valido=0;}
            });
            $( ".form-id-Ingrediente" ).each(function(){
                if($(this).val()=="Seleccionar..."){valido=0;}
            });
            $( ".form-cant-Ingrediente" ).each(function(){
                if($(this).val()==""){valido=0;}
            });

            if(valido==1){  // si todos los campos estan llenos

                // estas dos lineas serializan el formulario
                var form = $('div#Agregar-platillo').find('form#Agregar-platillo-Form')[0];
                var formulario = new FormData(form);
                // SE COLOCA UNA COOKIE CON EL NUMERO DE IngredienteS
                $.cookie('contador', ing, {path: '/'});


                //SE ENVIA EL DORMULARIO SERIALIZADO POR AJAX A FUNCIONAGREGAR
                $.ajax({
                    data: formulario, 
                    url: 'php/platillo/funcionAgregar.php',
                    type: 'POST',   
                    async: false,     
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (infoRegreso) {
                        alertify.alert(infoRegreso);
                        $.ajax({ 
                            type: "POST", 
                            url: 'modulos/menu/platillo.php',  
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