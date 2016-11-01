<h1>Ventas del dia</h1>
<button class="button-xlarge button-secondary pure-button corte"><i class="fa fa-times" aria-hidden="true"></i> Corte de caja</button>
<button class="button-xlarge button-secondary pure-button reporte"><i class="fa fa-list-alt" aria-hidden="true"></i> Reporte del mes</button>
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
    <br/>
    <?php
        $ven -> listarTotales();
    ?>
</div>
<script> 
    //--------- Boton de cancelar Promo
    $('.reporte').click(function(event){
        event.preventDefault();
        $.ajax({ 
            type: "POST", 
            url: 'php/venta/reporte.php',  
            success: function(data) {
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });    
    });    
</script>