<h1>Promociones</h1>
<button class="button-xlarge button-warning pure-button add-promo"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Precio</th>
                <th class="highlight">Fecha</th>
                <th class="highlight">Editar</th>
                <th class="highlight">Eliminar</th>
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
<script type="text/javascript">
    //---------- Boton de eliminar producto del promo
    $('.delete-promo').click(function(event){

        var id=$(this).attr('id');
        alertify.alertify.alert("Eliminado");
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/promo/eliminar.php',  
            success: function(data) { 
                $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/promo.php',  
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
     //---------- Boton de agregar producto al promo
    $('.add-promo').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/promo/agregar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>