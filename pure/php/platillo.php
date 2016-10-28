<?php

class platillo
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
    
 //--------------- Verificar y crear sesión de Administrador
    public function listarPlatillos()
    {
        $this->conectar();
        $platillo="";
        $sql = "SELECT * FROM platillos WHERE status='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $platillo .= '<tr>
                        <td class="highlight">'.$row['nombre'].'</td>
                        <td class="highlight">'.$row['descripcion'].'</td>
                        <td class="highlight">'.$row['categoria'].'</td>
                        <td class="highlight">'.$row['precio'].'</td>   
                        <td class="highlight">'.$row['precioDescuento'].'</td>
                        <td class="highlight"><i id="'.$row['id'].'" class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                        </tr>';
                }
            }
            echo $platillo;
            $this->con->close();
    }
}