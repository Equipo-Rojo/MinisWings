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
        $sql = "SELECT * FROM empleado WHERE nickname='".$nick."' AND Contraseña='".$pass."'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                $result = $result->fetch_assoc();
                date_default_timezone_set('America/mexico_city'); 
                $entrada=date('Y-m-d H:i:s');
                $sql1="INSERT INTO asistencia (id_Emp, Fecha_Entrada) VALUES (".$result['id_Em'].", '".$entrada."')";
               
                $result1 = $this->con->query($sql1);
                if($this->con->affected_rows){
                    echo "<script type='text/javascript'>alertify.alert('Exito! Bienvenido  ');</script>";
                    session_start();
                    $_SESSION['id']=$result['id_Em'];
                    $_SESSION['entrada']=$entrada;
                    $_SESSION['user']=$result['nickname'];
                    $_SESSION['type']=$result['Rol'];
                    switch ($result['Rol']) {
                        case 'Administrador':
                            header('Location: panel/administrador/');                
                            break;
                        case 'Cocinero':
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
            }
            else {
                 echo "<script type='text/javascript'>alertify.alert('Verifica los datos');</script>";
            }
            $this->con->close();
    }   
}