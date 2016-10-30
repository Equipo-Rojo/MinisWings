<?php

class promo
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
    public function listarPromo()
    {
        $this->conectar();
        $platillo="";
        $sql = "SELECT * FROM promos WHERE Estado='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $platillo .= '<tr>
                        <td class="highlight">'.$row['Nombre'].'</td>
                        <td class="highlight">'.$row['Fecha'].'</td>
                        <td class="highlight">'.$row['Precio'].'</td>   
                        <td class="highlight">'.$row['Estado'].'</td>
                        </tr>';
                }
            }
            echo $platillo;
            $this->con->close();
    }
}