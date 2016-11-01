 <?php 
    date_default_timezone_set('America/mexico_city'); 
    $hora_real=date("H:i:s");

    $hrs = "16";
    $min = "00";
    $hora_base = date("H:i:s",mktime($hrs,$min,0));

    if($hora_real>$hora_base){ //si pasa de las 4 pm
        $hoy = date('Y-m-d');
        $d=date('d', strtotime($hoy));
        $m=date('m', strtotime($hoy));
        $y=date('Y', strtotime($hoy));
        $dia = date("Y-m-d H:i:s",mktime($hrs,$min,0,$m,$d,$y));
    }
    else{
        $hoy = date('Y-m-d');
        $ayer = strtotime ('-1 day' , strtotime($hoy)) ;
        $ayer = date ('Y-m-d', $ayer);
        $d=date('d', strtotime($ayer));
        $m=date('m', strtotime($ayer));
        $y=date('Y', strtotime($ayer));
        $dia = date("Y-m-d H:i:s",mktime($hrs,$min,0,$m,$d,$y));
    }

?>
<h1>Ventas del dia</h1>
<?php
    include('../../php/conexion.php');
    $con = new Conexion('datosServer.php');
    $con = $con->conectar();

   //$sql = "SELECT * FROM corte WHERE Fecha>'".$dia."'";
   $sql = "SELECT * FROM corte WHERE Fecha<'".$dia."'";
    $result = $con->query($sql);
    if ($result->num_rows == 0) {
        echo '<button class="button-xlarge button-secondary pure-button corte"><i class="fa fa-times" aria-hidden="true"></i> Corte de caja</button>';
        
    }
    $con->close();
?>

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
    $('.corte').click(function(event){
        event.preventDefault();
        $.ajax({ 
            type: "POST", 
            url: 'php/venta/corte.php',  
            success: function(data) {
                alertify.alert("Se registró el corte");
                $.ajax({ 
                    type: "POST", 
                    url: 'php/venta/reporte.php',  
                    success: function(data) {
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                });    
            }  
        });    
    });    
</script>