<h1>Platillos</h1>
<button class="button-xlarge button-warning pure-button"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
<br/><br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Categoria</th>
                <th class="highlight">Precio</th>
                <th class="highlight">c/Descuento</th>
                <th class="highlight">Editar</th>
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