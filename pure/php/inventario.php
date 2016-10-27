<?php

class inventario
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
    public function listarInventario()
    {
        $this->conectar();
        $producto="";
        $sql = "SELECT * FROM inventario WHERE status='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $producto .= '<tr>
                        <td class="highlight">'.$row['producto'].'</td>
                        <td class="highlight">'.$row['descripcion'].'</td>
                        <td class="highlight">'.$row['existencia'].'</td>
                        <td class="highlight">'.$row['minimo'].'</td>
                        <td class="highlight"></td>
                        </tr>';
                }
            }
            echo $producto;
            $this->con->close();
    }
}