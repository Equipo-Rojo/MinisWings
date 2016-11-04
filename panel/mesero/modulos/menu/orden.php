 <?php
        date_default_timezone_set('America/mexico_city'); 
        $hora_real=date("H:i:s");

        $hrs = "14";
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
        include('../../php/conexion.php');
        $con = new Conexion('datosServer.php');
        $con = $con->conectar();
        
?>
<div class="orden1">
    <h1>Ordenes</h1>
    <?php
        
        $sql = "SELECT * FROM corte WHERE Fecha>'".$dia."'";
        echo $sql;
        $result = $con->query($sql);
        if ($result->num_rows < 1) {
            echo '<button class="button-xlarge  pure-button add-cuenta"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Cuenta/Mesa</button>';
        }
        else {echo '<h2> Ya se ha efectuado el corte de caja</h2>';}
    ?>
    
    <br/><br/>
    <div id="panel-cuentas">
         <?php
            include('../../php/cuenta.php');
            $pla = new orden();
            $pla -> listarCuentas();
        ?>
    </div>
</div>
<script type="text/javascript">
     //---------- Boton de agregar cuenta
    $('.add-cuenta').click(function(event){
        $.ajax({ 
            type: "POST", 
            url: 'php/ordenes/add-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });
    //---------- Boton de agregar orden
    $('.add-orden').click(function(event){
        
        var id_cue=$(this).attr('id');

        $.ajax({
            data:{id_Cue:id_cue}, 
            type: "POST", 
            url: 'php/ordenes/add-orden.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });
    //---------- Boton de pagar cuenta
    $('.pedir-cuenta').click(function(event){
        var id_cue=$(this).attr('id');
        $.ajax({ 
            data:{id_Cue:id_cue}, 
            type: "POST", 
            url: 'php/ordenes/pedir-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        }); 
    });
    //---------- Boton de editar cuenta
    $('.edite-cuenta').click(function(event){
        
        var id_cue=$(this).attr('id');

        $.ajax({
            data:{id_Cue:id_cue}, 
            type: "POST", 
            url: 'php/ordenes/editar-cuenta.php',  
            success: function(data) {  
                $("div#main").empty();
                $("div#main").append(data);
            }  
        });  
    });   
</script>