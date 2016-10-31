<?php
session_start();
$user="".$_SESSION['user'];
//$pass=$_POST['pass'];
//$new=$_POST['new'];
$password=$_POST['pass'];
$new=$_POST['new'];
//include('../usuario.php');
$usuario = new usuario();
$usuario->change($user, $password,$new);

class usuario
{
    //Atributos globales. 
    private $host="";
    private $user="";
    private $pw="";
    private $db="";
    private $con;
    
    public function __construct() {
        include('../datosServer.php');
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
    public function change($nick, $pass,$new)
    {
        $pass=sha1($pass);
        $new=sha1($new);
        $this->conectar();
        $sql = "SELECT * FROM empleado WHERE nickname='".$nick."' AND Contraseña='".$pass."'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                $sql = "UPDATE empleado SET Contraseña='".$new."' WHERE nickname='".$nick."'";
                $result = $this->con->query($sql);
                if($this->con->affected_rows){
                    echo "Exito";
                }else{
                    echo "Error";
                }
            }
            else {
                 echo "Verifica los datos";
            }
            $this->con->close();
    }   
}
?>