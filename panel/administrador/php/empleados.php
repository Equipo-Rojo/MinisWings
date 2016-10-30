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
    
 //--------------- Listar empleados
    public function listarEmpelados()
    {
        $this->conectar();
        $empleado="";
        $sql = "SELECT * FROM empleado WHERE Estado='activo' AND Rol NOT LIKE 'Administrador'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $empleado .= '<tr>
                        <td class="highlight">'.$row['Nombre'].'</td>
                        <td class="highlight">'.$row['Apellido'].'</td>
                        <td class="highlight">'.$row['Rol'].'</td>
                        <td class="highlight"><i id="'.$row['id_Em'].'" class="fa fa-pencil-square-o edite-empleado" aria-hidden="true"></i></td>
                        <td class="highlight"><i id="'.$row['id_Em'].'" class="fa fa-trash delete-empleado" aria-hidden="true"></i></td>
                        </tr>';
                }
            }
        echo $empleado;
        $this->con->close();
    }
     //--------------- Editar empleados
        public function eliminarEmpleado($id)
    {   
        $this->conectar();
        $sql = "UPDATE empleado SET Estado='inactivo' WHERE id_Em='".$id."'";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Exito";
        }        
        $this->con->close();
    }
    //--------------- Editar empleado
    public function editarEmpleado($datos,$id)
    {   
        $sql = $sql = "UPDATE empleado SET";

        foreach($datos as $dato)
        {
            $sql.=$dato.',';
        }
        $sql=substr($sql, 0, -1);
        $sql.="WHERE id_Em=".$id;
        $this->conectar();
        $result = $this->con->query($sql);
      /*  if($this->con->affected_rows){
            echo 'modulos/menu/empleados.php';
        } */     
        $this->con->close();
    }
     //--------------- Reset Pass de empleado
        public function resetEmpleado($id,$roll)
    {   
        $pass=sha1($roll."123");
        $this->conectar();
        $sql = "UPDATE empleado SET Contraseña='".$pass."' WHERE id_Em='".$id."'";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Exito";
        }        
        $this->con->close();
    }
     //--------------- Agregar empleado
    public function agregarEmpleado($datos, $campos)
    {   
        $sql = $sql = "INSERT INTO empleado (";

        foreach($campos as $campo)
        {
            $sql.=$campo.',';
        }
        $sql=substr($sql, 0, -1);
        $sql.=') VALUES(';
     
        foreach($datos as $dato)
        {
            $sql.=$dato.',';
        }
        $sql=substr($sql, 0, -1);   
        $sql.=');';
    
        $this->conectar();
        $result = $this->con->query($sql);

        
            $sql = "SELECT id_Em, Contraseña FROM empleado WHERE LENGTH(Contraseña)<40";
            $result = $this->con->query($sql);
                $result=$result->fetch_assoc();
                $id=$result['id_Em'];
                $pass=sha1($result['Contraseña']);
                $sql = "UPDATE empleado SET Contraseña='".$pass."' WHERE id_Em=".$id;
                $result = $this->con->query($sql);
            
        
        $this->con->close();
    }
}