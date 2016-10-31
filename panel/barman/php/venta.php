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
        $this->conectar();
        $producto="";
        $sql = "SELECT * FROM venta";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $producto .= '<tr>
                        <td>'.$row['id_Cue'].'</td>
                        <td>'.$row['Estado'].'</td>
                        <td>'.$row['Fecha_Apertura'].'</td>
                        <td>'.$row['Fecha_Cierre'].'</td>
                        <td>'.$row['Total_Cierre'].'</td>
                        </tr>';
                }
            }
            echo $producto;
            $this->con->close();
    }
}