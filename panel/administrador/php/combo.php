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
                        <td class="">'.$row['nombre'].'</td>
                        <td class="">'.$row['descripcion'].'</td> 
                        <td class="">'.$row['precio'].'</td>
                        <td class=""><i id="'.$row['id_Comb'].'" class="fa fa-pencil-square-o edite-combo" aria-hidden="true"></i></td>
                        <td class=""><i id="'.$row['id_Comb'].'" class="fa fa-trash delete-combo" aria-hidden="true"></i></td> 
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
        $Platillo='<div id="combo'.$num.'" class="pure-u-1 pure-u-md-1-3">
        <select class="pure-u-1-2 form-id-Platillo" name="id_Plat" value=""><option>Seleccionar...</option>';

        $sql = "SELECT * FROM platillo WHERE Estado='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $Platillo.= '<option name="id_Plat" value="'.$row['id_Plat'].'">'.$row['nombre'].'</option>';
            }
        }
        $Platillo.='</select>
        <input type="number" min="1" class="pure-u-1-2 form-cant-Platillo" placeholder="Cantidad"/></div>';
        echo $Platillo;
        $this->con->close();
    }

    //--------------- Agregar combo
    public function agregarcombo($datoscombo, $camposcombo,$idPlatillo, $cantPlatillo, $url_temp)
    {   
        //-----Construccion de sentencia para combo
        $sql = "INSERT INTO combos (";
        foreach($camposcombo as $campo)
        {   $sql.=$campo.',';   }
        $sql=substr($sql, 0, -1);
        $sql.=') VALUES(';
        foreach($datoscombo as $dato)
        {   $sql.=$dato.',';    }
        $sql=substr($sql, 0, -1);
        $sql.=');';
        $this->conectar();
        $result = $this->con->query($sql);  // se ejecuta la sentencia

        //-----Construcción de sentencia para platillos
        if($this->con->affected_rows){

            $sql = "SELECT * FROM combos WHERE Estado='activo' AND Url=''"; //consultar id del combo insertado
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                $row=$result->fetch_assoc();
                $id_Comb=$row['id_Comb'];

                $cont=count($idPlatillo); //cantidad de campos a ingresar

                for($i=0;$i<$cont;$i++)  // insertar cada campo de la relacion
                {
                    $sql="INSERT INTO r_c_pl (id_Comb,id_Plat,cant) VALUES (".$id_Comb.",".$idPlatillo[$i].",".$cantPlatillo[$i].")";
                    $result = $this->con->query($sql);
                }
                
                ///-----Construir ruta final
                $ruta_final="C:\xampp\htdocs\pure\img\combo\combo_".$id_Comb."jpg";
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $nuevaImagenconExt);

                //--- insertar ruta de imagen
                $sql = "UPDATE combos SET Url='".$ruta_final."' WHERE id_Comb='".$id_Comb."'";
                $result = $this->con->query($sql);
                if($this->con->affected_rows){
                    echo "modulos/menu/combo.php";
                }
            }
        }      
        //----------------------------------------

        $this->con->close();
        
        
    }
}