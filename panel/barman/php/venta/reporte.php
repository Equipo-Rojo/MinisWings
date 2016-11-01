<h1>Cortes del mes</h1>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th >#</th>
                <th >Fecha de corte</th>
                <th >Subtotal</th>
                <th >Cortesias</th>
                <th >Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('../venta.php');
        $ven = new venta();
        $ven -> listarVentaReporte();
        ?>
            
        </tbody>
    </table>
    <br/>
    <?php
        $ven -> listarTotalesReporte();
    ?>
</div>