<br/><h1>Producto escaso</h1>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Existencia</th>
                <th>Stock minimo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../../php/inventario.php');
                $inv = new inventario();
                $inv -> listarAlerta();
            ?>
        </tbody>
    </table>
</div>
<br/><h1>Empleados conectados</h1>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../../php/asistencia.php');
                $asis = new asistencia();
                $asis -> listarAsistencia();
            ?>
        </tbody>
    </table>
</div>
