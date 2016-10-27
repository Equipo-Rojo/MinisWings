<h1>Pagina principal</h1>
<h2>Promociones vigentes</h2>
<button>Agregar</button>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Descripción</th>
                <th class="highlight">Precio</th>
                <th class="highlight">c/Descuento</th>
                <th class="highlight">Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include('../../../php/platillo.php');
                $pla = new platillo();
                $pla -> listarPlatillos();
            ?>
        </tbody>
    </table>
</div>
<h2>Datos de contacto</h2>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th class="highlight">Nombre</th>
                <th class="highlight">Telefono</th>
                <th class="highlight">Celular</th>
                <th class="highlight">Dirección</th>
            </tr>
        </thead>
        <tbody>
           	<td class="highlight">Erick Pérez</td>
	        <td class="highlight">3 56 78 75</td>
	        <td class="highlight">443 3578 123</td>
	        <td class="highlight">Tecologico #156 Fracc. Altozano</td>
        </tbody>
    </table>
</div>