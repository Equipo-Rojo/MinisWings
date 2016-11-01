<h1>Ventas del dia</h1>
<button class="button-xlarge button-secondary pure-button add-promo"><i class="fa fa-plus" aria-hidden="true"></i> Corte de caja    </button>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th ># Cuenta</th>
                <th >Estado</th>
                <th >Apertura</th>
                <th >Cierre</th>
                <th >Total</th>
            </tr>
        </thead>
        <tbody>
         <?php
        include('../../php/venta.php');
        $ven = new venta();
        $ven -> listarVenta();
        ?>
            
        </tbody>
    </table>
</div>