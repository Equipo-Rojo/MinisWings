<h1>Platillos</h1>
<button class="button-xlarge button-warning pure-button add-platillo"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Categoria</th>
                <th class="highlight">Precio</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Editar</th>
                <th class="highlight">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../../php/platillo.php');
                $pla = new platillo();
                $pla -> listarPlatillos();
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    //---------- Boton de eliminar producto del platillo
    $('.delete-platillo').click(function(event){

        var id=$(this).attr('id');
        alertify.alert("Eliminado");
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/platillo/eliminar.php',  
            success: function(data) { 
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
    });   
     //---------- Boton de editar producto del platillo
    $('.edite-platillo').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/platillo/editar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
     //---------- Boton de agregar producto al platillo
    $('.add-platillo').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/platillo/agregar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>