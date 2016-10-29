<br/><h1>Producto escaso</h1>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Producto</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Existencia</th>
                <th class="highlight">Stock minimo</th>
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
