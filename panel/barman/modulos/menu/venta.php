<h1>Ventas</h1>
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