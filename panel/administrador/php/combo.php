<?php

class combo
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
    
    //--------------- Listar combos
    public function listarcombos()
    {
        $this->conectar();
        $combo="";
        $sql = "SELECT * FROM combos WHERE Estado='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $combo .= '<tr>
                        <td class="highlight">'.$row['nombre'].'</td>
                        <td class="highlight">'.$row['descripcion'].'</td> 
                        <td class="highlight">'.$row['precio'].'</td>
                        <td class="highlight"><i id="'.$row['id_Comb'].'" class="fa fa-pencil-square-o edite-combo" aria-hidden="true"></i></td>
                        <td class="highlight"><i id="'.$row['id_Comb'].'" class="fa fa-trash delete-combo" aria-hidden="true"></i></td> 
                        </tr>';
                }
            }
            echo $combo;
            $this->con->close();
    }
        //--------------- Eliminar combo
    public function eliminarcombo($id)
    {   
        $this->conectar();
        $sql = "UPDATE combos SET Estado='inactivo' WHERE id_Comb='".$id."'";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Exito";
        }        
        $this->con->close();
    }
    //--------------Listar Platillos
    public function listarPlatillo($num){
        $this->conectar();
        $Platillo='<div id="combo'.$num.'" class="pure-u-1 pure-u-md-1-3"><select class="pure-u-1-2 form-add-Platillo" name="id_Inv" value=""><option>Seleccionar...</option>';

        $sql = "SELECT * FROM inventario WHERE status='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $Platillo.= '<option name="id_Inv" value="'.$row['id_Inv'].'">'.$row['nombre'].'</option>';
            }
        }
        $Platillo.='</select></div>';
        echo $Platillo;
        $this->con->close();
    }

    //--------------- Agregar pcombo
    public function agregarcombo($datoscombo, $camposcombo,$datosPlatillo, $camposPlatillo)
    {   
        /*$sql = $sql = "INSERT INTO inventario (";

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
            echo 'modulos/menu/combo.php';
        }      
        $this->con->close();
        */
        echo 'modulos/menu/combo.php';
    }
}