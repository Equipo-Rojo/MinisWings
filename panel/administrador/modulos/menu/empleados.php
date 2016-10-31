<h1>Empleados</h1>
<button class="button-xlarge button-warning pure-button add-empleado"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Roll</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
        	<?php
		    	include('../../php/empleados.php');
	            $emp = new empleado();
	            $emp -> listarEmpelados();
	        ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    //---------- Boton de eliminar empleado
    $('.delete-empleado').click(function(event){
        var id=$(this).attr('id');
        alertify.alert("Eliminado");
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/empleado/eliminar.php',  
            success: function(data) { 
                $.ajax({ 
                type: "POST", 
                url: 'modulos/menu/empleados.php',  
                success: function(data) {  
                    $("div#main").empty();
                    $("div#main").append(data);
                }  
                });
            }  
        });  
    });   
     //---------- Boton de editar empleado
    $('.edite-empleado').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/empleado/editar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
     //---------- Boton de agregar empleado
    $('.add-empleado').click(function(event){
        var id=$(this).attr('id');
        $.ajax({ 
            data : {id:id},
            type: "POST", 
            url: 'php/empleado/agregar.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>