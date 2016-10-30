<h1>Inventario</h1>
<button class="button-xlarge button-warning pure-button add-inventario"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>

<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Producto</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Existencia</th>
                <th class="highlight">Stock minimo</th>
                <th class="highlight">Editar</th>
                <th class="highlight">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../../php/inventario.php');
                $inv = new inventario();
                $inv -> listarInventario();
            ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    //---------- Boton de eliminar producto del inventario
    $('.delete-inventario').click(function(event){

        var id=$(this).attr('id');
        alert("Eliminado");
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/inventario/eliminar.php',  
            success: function(data) { 
                $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/inventario.php',  
                success: function(data) {  
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
                });
            }  
        });  
    });   
     //---------- Boton de editar producto del inventario
    $('.edite-inventario').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/inventario/editar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
     //---------- Boton de agregar producto al inventario
    $('.add-inventario').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/inventario/agregar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>