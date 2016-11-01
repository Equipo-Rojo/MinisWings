<?php

class venta
{
    //Atributos globales. 
    private $host="";
    private $user="";
    private $pw="";
    private $db="";
    private $con;
    public $total=0;
    public $cortesias=0;
    public $subtotal=0;
    public $totalR=0;
    public $cortesiasR=0;
    public $subtotalR=0;
    
	public function __construct() {
		include('datosServer.php');
		$this->host = $ho;
		$this->user = $us;
		$this->pw = $pw;
		$this->db = $db;	
	}    
    //--------------- función para conectar
    public function conectar()
    {
       $this -> con = new mysqli($this->host, $this->user, $this->pw, $this->db);
       $this->con->set_charset('utf8');
        if (mysqli_connect_error()) {
            die("Error en conexión: " . mysqli_connect_error());
        }    
    } 
    //--------------- Listar venta 
    public function listarVenta()
    {
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
        echo '<br/>';
        $this->conectar();
       
        $producto="";
        $sql = "SELECT * FROM venta WHERE Fecha_Apertura>'".$dia."'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $producto .= '<tr>
                        <td>'.$row['id_Cue'].'</td>
                        <td>'.$row['Estado'].'</td>
                        <td>'.date("Y-m-d",strtotime($row['Fecha_Apertura'])).'</td>
                        <td>'.$row['Fecha_Cierre'].'</td>
                        <td>$ '.number_format($row['Total_Cierre'],2).'</td>
                        </tr>';
                        $this->subtotal+=$row['Total_Cierre'];
                        if($row['Estado']=="Cortesia"){
                            $this->cortesias+=$row['Total_Cierre'];
                        }
                        $this->total=$this->subtotal-$this->cortesias;
                }
            }
           
            echo $producto;
            $this->con->close();
    }
    //--------------- Listar venta 
    public function listarTotales()
    {
        $total='
        <table class="mq-table pure-table-bordered pure-table">
            <thead>
                <tr>
                    <th >Subtotal</th>
                    <th >Cortesias</th>
                    <th >Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$ '.number_format($this->subtotal,2).'</td>
                    <td>$ '.number_format($this->cortesias,2).'</td>
                    <td>$ '.number_format($this->total,2).'</td>
                </tr>
            </tbody>
        </table>';
 
        echo $total;
    }
     //--------------- Listar venta 
    public function listarVentaReporte()
    {
        date_default_timezone_set('America/mexico_city'); 
        
        $hoy = date('Y-m-d H:i:s');
        $m_actual=date('m', strtotime($hoy));
        $a_actual=date('Y', strtotime($hoy));
        $fecha_inio = date("Y-m-d H:i:s",mktime(0,0,0,$m_actual,1,$a_actual));

        echo '<br/>';
        $this->conectar();
       
        $producto="";
        $sql = "SELECT * FROM corte WHERE Fecha BETWEEN '".$fecha_inio."' AND '".$hoy."'";
 
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $producto .= '<tr>
                        <td>'.$row['id_Cort'].'</td>
                        <td>'.date("Y-m-d",strtotime($row['Fecha'])).'</td>
                        <td>'.number_format($row['Subtotal'],2).'</td>
                        <td>'.number_format($row['Cortesias'],2).'</td>
                        <td>$ '.number_format($row['Total'],2).'</td>
                        </tr>';
                        $this->subtotalR+=$row['Subtotal'];
                        $this->cortesiasR+=$row['Cortesias'];
                        $this->totalR+=$row['Total'];
                }
            }
           
            echo $producto;
            $this->con->close();
    }
    //--------------- Listar venta 
    public function listarTotalesReporte()
    {
        $total='
        <table class="mq-table pure-table-bordered pure-table">
            <thead>
                <tr>
                    <th >Subtotal</th>
                    <th >Cortesias</th>
                    <th >Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$ '.number_format($this->subtotalR,2).'</td>
                    <td>$ '.number_format($this->cortesiasR,2).'</td>
                    <td>$ '.number_format($this->totalR,2).'</td>
                </tr>
            </tbody>
        </table>';
 
        echo $total;
    }
}

 