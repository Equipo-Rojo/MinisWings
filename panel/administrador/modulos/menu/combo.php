<h1>Combos</h1>
<button class="button-xlarge button-warning pure-button add-combo"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Precio</th>
                <th class="highlight">Editar</th>
                <th class="highlight">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../../php/combo.php');
                $combo = new combo();
                $combo -> listarcombos();
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    //---------- Boton de eliminar producto del combo
    $('.delete-combo').click(function(event){

        var id=$(this).attr('id');
        alertify.alert("Eliminado");
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/combo/eliminar.php',  
            success: function(data) { 
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
    });   
     //---------- Boton de editar producto del combo
    $('.edite-combo').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/combo/editar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
     //---------- Boton de agregar producto al combo
    $('.add-combo').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/combo/agregar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>