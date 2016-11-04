<?php

class asistencia
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
    //--------------- Listar inventario activo
    public function listarAsistencia()
    {
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
        $hoy=date("Y-m-d H:i:s");
        echo '<br/>';
        $this->conectar();
       
        $producto="";
        $sql = "SELECT * FROM asistencia INNER JOIN empleado ON asistencia.id_Emp=empleado.id_Em WHERE Fecha_Entrada>'".$dia."' AND Fecha_Salida IS NULL";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $producto .= '<tr>
                        <td>'.$row['Nombre'].'</td>
                        <td>'.$row['Apellido'].'</td>
                        <td>'.date("Y-m-d",strtotime($row['Fecha_Entrada'])).'</td>
                        <td>'.date("H:i:s",strtotime($row['Fecha_Entrada'])).'</td>
                        </tr>';
                }
            }
           
            echo $producto;
            $this->con->close();
    }
}
?>