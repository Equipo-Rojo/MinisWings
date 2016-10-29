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
    //--------------- Listar inventario activo
    public function listarInventario()
    {
        $this->conectar();
        $producto="";
        $sql = "SELECT * FROM inventario WHERE status='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $producto .= '<tr>
                        <td class="highlight">'.$row['nombre'].'</td>
                        <td class="highlight">'.$row['descripcion'].'</td>
                        <td class="highlight">'.$row['cantidad'].'</td>
                        <td class="highlight">'.$row['minimo'].'</td>
                        <td class="highlight"><i id="'.$row['id_Inv'].'" class="fa fa-pencil-square-o edite-inventario" aria-hidden="true"></i></td>
                        <td class="highlight"><i id="'.$row['id_Inv'].'" class="fa fa-trash delete-inventario" aria-hidden="true"></i></td> 
                        </tr>';
                }
            }
            echo $producto;
            $this->con->close();
    }
    //--------------- Eliminar producto del inventario
    public function eliminarProducto($id)
    {   
        $this->conectar();
        $sql = "UPDATE inventario SET status='inactivo' WHERE id_Inv='".$id."'";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Exito";
        }        
        $this->con->close();
    }
    //--------------- Editar producto del inventario
    public function editarInventario($datos,$id)
    {   
        $sql = $sql = "UPDATE inventario SET";

        foreach($datos as $dato)
        {
            $sql.=$dato.',';
        }
        $sql=substr($sql, 0, -1);
        $sql.="WHERE id_Inv=".$id;
        $this->conectar();
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo 'modulos/menu/inventario.php';
        }      
        $this->con->close();
    }
    //--------------- Agregar producto al inventario
    public function agregarInventario($datos, $campos)
    {   
        $sql = $sql = "INSERT INTO inventario (";

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
        if($this->con->affected_rows){
            echo 'modulos/menu/inventario.php';
        }      
        $this->con->close();
    }
    //--------------- Listar inventario bajo
    public function listarAlerta()
    {
        $this->conectar();
        $producto="";
        $sql = "SELECT * FROM inventario WHERE status='activo' AND (minimo+20)>=cantidad";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $producto .= '<tr>
                    <td class="highlight">'.$row['nombre'].'</td>
                    <td class="highlight">'.$row['descripcion'].'</td>
                    <td class="highlight">'.$row['cantidad'].'</td>
                    <td class="highlight">'.$row['minimo'].'</td>
                    </tr>';
            }
        }
        echo $producto;
        $this->con->close();
    }
    //--------------- contar bajo inventario
    public function  contarAlerta()
    {
        $this->conectar();
        $producto="";
        $sql = "SELECT count(*) as cant FROM inventario WHERE status='activo' AND (minimo+20)>=cantidad";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
           $producto= $result->fetch_assoc();
        }
        echo $producto['cant'];
        $this->con->close();
    }
}