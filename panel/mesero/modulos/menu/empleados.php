<h1>Empleados</h1>
<button class="button-xlarge button-warning pure-button"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Apellidos</th>
                <th class="highlight">Roll</th>
                <th class="highlight">Editar</th>
                <th class="highlight">Eliminar</th>
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