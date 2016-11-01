<?php

class venta
{
    //Atributos globales. 
    private $host="";
    private $user="";
    private $pw="";
    private $db="";
    private $con;
    
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
                }
            }
            echo $producto;
            $this->con->close();
    }
}