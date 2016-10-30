
    
<?php

class contacto
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
    public function listarContacto()
    {
        $this->conectar();
        $platillo="";
        $sql = "SELECT * FROM contactos";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $platillo .= '<tr>
                        <td class="highlight">'.$row['nombre'].'</td>
                        <td class="highlight">'.$row['direccion'].'</td>
                        <td class="highlight">'.$row['facebook'].'</td>   
                        <td class="highlight">'.$row['telefono'].'</td>
                        <td class="highlight">'.$row['celular'].'</td>
                        </tr>';
                }
            }
            echo $platillo;
            $this->con->close();
    }
    //--------------- Editar producto del inventario
    public function editarContacto($datos)
    {   
        $sql = $sql = "UPDATE contactos SET";

        foreach($datos as $dato)
        {
            $sql.=$dato.',';
        }
        $sql=substr($sql, 0, -1);
        $sql.="WHERE id=1";
        $this->conectar();
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo 'modulos/menu/page.php';
        }      
        $this->con->close();
    }
}

?>

