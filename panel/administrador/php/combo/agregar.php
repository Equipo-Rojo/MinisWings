<style type="text/css">.thumb-image{float:right;width:100px;position:relative;padding:none;}</style>
<h1>Agregar combo</h1>
<div id="Agregar-Combo"><form id="Agregar-Combo-Fom" class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Nuevo combo</legend>

        <div id="wrapper" style="margin-top: 20px;">
            <input id="fileUpload" class="form-add-platillo button-secondary pure-button" name="url" multiple="multiple" type="file"/> 
            <div id="image-holder"></div>
        </div> 

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre del combo</label>
                <input id="nom" class="pure-u-1-2 form-add-combo" type="text" name="nombre" value="" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Precio</label>
                <input id="pre" class="pure-u-1-2 form-add-combo" type="number" name="precio" value="" min="1" required >
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="des" class="pure-u-1-2 form-add-combo" type="text" name="descripcion" value="" required ></textarea>
            </div>

        </div>
        <legend>Platillos</legend>
        <div id="combo" class="pure-g">
            <?php
                include('../combo.php');
                $ing = new combo();
                $ing -> listarPlatillo(1);
            ?>
        </div>
        <button id="agregar" type="button" class="pure-button "><i class="fa fa-plus" aria-hidden="true"></i> Agregar Platillo</button>
        <button id="borrar" type="button" class="pure-button button-secondary"><i class="fa fa-minus-circle" aria-hidden="true"></i> Borrar último Platillo</button>
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
        //---------- Boton de cancelar combo
        $('#cancelar').click(function(event){
            event.preventDefault();
            $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/combo.php',  
                success: function(data) {
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
            });    
        });
        //---------- Boton de agregar Platillo
        $('#agregar').click(function(event){
            event.preventDefault();
            ing++;
            $.ajax({ 
                data:{num:ing},
                type: "POST", 
                url: 'php/combo/Platillo.php',  
                success: function(data) {
                    $("#combo").append(data);
                }  
            });  
        });  
        //---------- Boton de borrar Platillo
        $('#borrar').click(function(event){
            event.preventDefault();
            $("#combo"+ing).remove();
            ing--;   
        });  
        //---------- Boton de guardar combo
        $('#guardar').click(function(event){
            event.preventDefault();

            var valido=1; // 1 = campos completos: 0 = faltan campos de llenar

            // aqui se valida que todos los campos esten llenos
            $( ".form-add-combo" ).each(function(){
                if($(this).val()=="" ||  $(this).val()=="Seleccionar..."){valido=0;}
            });
            $( ".form-id-Platillo" ).each(function(){
                if($(this).val()=="Seleccionar..."){valido=0;}
            });
            $( ".form-cant-Platillo" ).each(function(){
                if($(this).val()==""){valido=0;}
            });

            if(valido==1){  // si todos los campos estan llenos

                // estas dos lineas serializan el formulario
                var form = $('div#Agregar-Combo').find('form#Agregar-Combo-Fom')[0];
                var formulario = new FormData(form);
                // SE COLOCA UNA COOKIE CON EL NUMERO DE PLATILLOS
                $.cookie('contador', ing, {path: '/'});


                //SE ENVIA EL DORMULARIO SERIALIZADO POR AJAX A FUNCIONAGREGAR
                $.ajax({
                    data: formulario, 
                    url: 'php/combo/funcionAgregar.php',
                    type: 'POST',   
                    async: false,     
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (infoRegreso) {
                        alertify.alert(infoRegreso);
                        $.ajax({ 
                            type: "POST", 
                            url: 'modulos/menu/combo.php',  
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