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

?>
<h1>Cuentas por pagar</h1>
<br/>
<div class="table-responsive">
    <table class="mq-table pure-table-bordered pure-table">
        <thead>
            <tr>
                <th >Lugar</th>
                <th >Estado</th>
                <th >Total</th>
                <th >Pagar</th>
                <th >Cortesia</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('../../php/cuentasMesas.php');
        $ven = new cuentaMesa();
        $ven -> listarCuentas();
        ?>
            
        </tbody>
    </table>
</div>
<script> 
   //---------- Boton guardar
     $('.pagar').click(function(event){

        event.preventDefault();
        var id_Cue=$(this).attr('id');
        
        $.ajax({ 
            data:{id_Cue:id_Cue},
            type: "POST", 
            url: 'php/cuentas/funcionPagar.php',  
            success: function(data) { 
                alertify.alert(data);  
                $.ajax({
                    type: "POST", 
                    url: 'modulos/menu/cuentas.php',  
                    success: function(data) {
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                }); 
            }  
        });
    });   
      //---------- Boton cortesia
     $('.cortesia').click(function(event){

        event.preventDefault();
        var id_Cue=$(this).attr('id');
       
        
        $.ajax({ 
            data:{id_Cue:id_Cue},
            type: "POST", 
            url: 'php/cuentas/funcionCortesia.php',  
            success: function(data) { 
                alertify.alert(data);  
                $.ajax({
                    type: "POST", 
                    url: 'modulos/menu/cuentas.php',  
                    success: function(data) {
                        $("div#main").empty();
                        $("div#main").append(data);
                    }  
                }); 
            }  
        });
    });   
</script>