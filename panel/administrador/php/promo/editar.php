<?php
    $id=$_POST['id'];
    setcookie ("promo", $id, 0, '/');
    include('../conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

    $sql = "SELECT * FROM promos WHERE id_Promo=".$id;
    $result = $con->query($sql);
    $producto = $result->fetch_assoc();
?>
<style type="text/css">.thumb-image{float:right;width:100px;position:relative;padding:none;}</style>
<h1>Editar promoción</h1>
<div id="Editar-promo"><form id="Editar-promo-Form" class="pure-form pure-form-stacked">
    <fieldset>
        <legend><?php echo $producto['nombre']; ?></legend>

        <div id="wrapper" style="margin-top: 20px;">
            <input id="fileUpload" class="button-secondary pure-button" name="url" multiple="multiple" type="file"/> 
            <div id="image-holder"><img class="thumb-image" src="<?php echo '../../'.$producto['Url'];?>"></div>
        </div> 

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Nombre de la promoción</label>
                <input id="nom" class="pure-u-1-2 form-add-promo" type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Precio</label>
                <input id="pre" class="pure-u-1-2 form-add-promo" type="number" name="precio" value="<?php echo $producto['precio']; ?>" min="1" required >
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Descripción</label>
                <textarea id="des" class="pure-u-1-2 form-add-promo" type="text" name="descripcion" value="" required ><?php echo $producto['Descripcion']; ?></textarea>
            </div>

            <div class="pure-u-1 pure-u-md-1-3">
                <label for="">Fecha de vigencia</label>
                <input id="fec" class="pure-u-1-2 form-add-promo" type="date" name="fecha" value="<?php echo $producto['Fecha']; ?>" min="1" required >
            </div>

        </div>
        <legend>Platillos</legend>
        <div id="promo" class="pure-g">
            <?php
                include('../promo.php');
                $ing = new promo();
                $ing -> cargarPlatillo($id);
            ?>
        </div>
        <button id="Agregar" type="button" class="pure-button "><i class="fa fa-plus" aria-hidden="true"></i> Agregar Platillo</button>
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
        //---------- Boton de cancelar promo
        $('#cancelar').click(function(event){
            event.preventDefault();
            $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/promo.php',  
                success: function(data) {
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
            });    
        });
        //---------- Boton de Editar Platillo
        $('#Agregar').click(function(event){
            event.preventDefault();
            ing++;
            $.ajax({ 
                data:{num:ing},
                type: "POST", 
                url: 'php/promo/Platillo.php',  
                success: function(data) {
                    $("#promo").append(data);
                }  
            });  
        });  
        //---------- Boton de borrar Platillo
        $('#borrar').click(function(event){
            event.preventDefault();
            $("#promo"+ing).remove();
            ing--;   
        });  
        //---------- Boton de guardar promo
        $('#guardar').click(function(event){
            event.preventDefault();

            var valido=1; // 1 = campos completos: 0 = faltan campos de llenar

            // aqui se valida que todos los campos esten llenos
            $( ".form-add-promo" ).each(function(){
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
                var form = $('div#Editar-promo').find('form#Editar-promo-Form')[0];
                var formulario = new FormData(form);
                // SE COLOCA UNA COOKIE CON EL NUMERO DE PLATILLOS
                $.cookie('contador', ing, {path: '/'});


                //SE ENVIA EL DORMULARIO SERIALIZADO POR AJAX A FUNCIONEditar
                $.ajax({
                    data: formulario, 
                    url: 'php/promo/funcionEditar.php',
                    type: 'POST',   
                    async: false,     
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (infoRegreso) {
                        alertify.alert(infoRegreso);
                        $.ajax({ 
                            type: "POST", 
                            url: 'modulos/menu/promo.php',  
                            success: function(data) {
                                //$("div#main").empty();
                                //$("div#main").append(data);
                                location.reload();
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