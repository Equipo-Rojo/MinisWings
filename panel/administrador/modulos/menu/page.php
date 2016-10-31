<div class="pagina">
    <h1>Pagina principal</h1>
    <h2>Promociones vigentes</h2>
    <div class="table-responsive">
        <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Editar</th>
                    <th>Elimiar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('../../php/promo.php');
                    $pla = new promo();
                    $pla -> listarpromos();
                ?>
            </tbody>
        </table>
    </div>
    <h2>Datos de contacto</h2>
    <button class="button-xlarge button-secondary pure-button edite-contacto"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button>
    <div class="table-responsive">
        <table class="pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th id="Fbook">Facebook</th>
                    <th>Telefono</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include('../../php/contacto.php');
                    $pla = new contacto();
                    $pla -> listarContacto();
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    //---------- Boton de eliminar producto del inventario
    $('.edite-contacto').click(function(event){
        $.ajax({ 
            type: "POST", 
            url: 'php/contacto/contacto.php',  
            success: function(data) { 
                
                    $("div#main").empty();
                    $("div#main").append(data);
    
            }  
        });  
    });  
    //---------- Boton de eliminar producto del promo
    $('.delete-promo').click(function(event){
        var id=$(this).attr('id');
        alertify.alert("Eliminado");
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/promo/eliminar.php',  
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
    });   
     //---------- Boton de editar producto del promo
    $('.edite-promo').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/promo/editar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });  
    </script>