<?php

class Login
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
    public function login($nick, $pass)
    {
        $pass=sha1($pass);
        $this->conectar();
        $sql = "SELECT * FROM empleados WHERE nick='".$nick."' AND pass='".$pass."'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                echo "<script>alert('Exito! Bienvenido  ');</script>";
                session_start();
                $_SESSION['user']=$result['nombre'];
                $_SESSION['type']=$result['roll'];
                switch ($result['roll']) {
                    case 'Administrador':
                        header('Location: panel/administrador/');                
                        break;
                    case 'Cosinero':
                        header('Location: panel/cocinero/');
                        break;
                    case 'Barman':
                        header('Location: panel/barman/');
                        break;
                    case 'Mesero':
                        header('Location: panel/mesero');
                        break;
                }
            }
            else {
                 echo "<script>alert('Verifica los datos');</script>";
            }
            $this->con->close();
    }   
}