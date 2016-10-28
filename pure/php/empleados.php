<?php

class empleado
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
    public function listarEmpelados()
    {
        $this->conectar();
        $empleado="";
        $sql = "SELECT * FROM empleados WHERE status='activo' AND roll NOT LIKE 'Administrador'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $empleado .= '<tr>
                        <td class="highlight">'.$row['nombre'].'</td>
                        <td class="highlight">'.$row['apellidoP'].' '.$row['apellidoM'].'</td>
                        <td class="highlight">'.$row['roll'].'</td>
                        <td class="highlight"><i id="'.$row['id'].'" class="fa fa-pencil-square-o" aria-hidden="true"></i></td>
                        <td class="highlight"><i id="'.$row['id'].'" class="fa fa-trash" aria-hidden="true"></i></td>
                        </tr>';
                }
            }
            echo $empleado;
            $this->con->close();
    }
}