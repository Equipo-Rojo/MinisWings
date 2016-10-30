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
    
    //--------------- Listar platillos
    public function listarPlatillos()
    {
        $this->conectar();
        $platillo="";
        $sql = "SELECT * FROM platillo WHERE Estado='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $platillo .= '<tr>
                        <td class="highlight">'.$row['nombre'].'</td>
                        <td class="highlight">'.$row['categoria'].'</td>
                        <td class="highlight">'.$row['precio'].'</td>
                        <td class="highlight">'.$row['descripcion'].'</td>   
                        <td class="highlight"><i id="'.$row['id_Plat'].'" class="fa fa-pencil-square-o edite-platillo" aria-hidden="true"></i></td>
                        <td class="highlight"><i id="'.$row['id_Plat'].'" class="fa fa-trash delete-platillo" aria-hidden="true"></i></td> 
                        </tr>';
                }
            }
            echo $platillo;
            $this->con->close();
    }
        //--------------- Eliminar platillo
    public function eliminarPlatillo($id)
    {   
        $this->conectar();
        $sql = "UPDATE platillo SET Estado='inactivo' WHERE id_Plat='".$id."'";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Exito";
        }        
        $this->con->close();
    }
    //--------------Listar ingredientes
    public function listarIngrediente($num){
        $this->conectar();
        $ingrediente='<div id="platillo'.$num.'" class="pure-u-1 pure-u-md-1-3"><select class="pure-u-1-2 form-add-ingrediente" name="id_Inv" value=""><option>Seleccionar...</option>';

        $sql = "SELECT * FROM inventario WHERE status='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $ingrediente.= '<option name="id_Inv" value="'.$row['id_Inv'].'">'.$row['nombre'].'</option>';
            }
        }
        $ingrediente.='</select></div>';
        echo $ingrediente;
        $this->con->close();
    }

    //--------------- Agregar pplatillo
    public function agregarPlatillo($datosPlatillo, $camposPlatillo,$datosIngrediente, $camposIngrediente)
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
}