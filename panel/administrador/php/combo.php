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

        // ES IMPORTANTE CADA SELECT Y CADA INPUT TENGA UN NAME CONCATENABLE PARA DIFERENCIARLOS 
        $this->conectar();
        $Platillo='<div id="combo'.$num.'" class="pure-u-1 pure-u-md-1-3">
        <select class="pure-u-1-2 form-id-Platillo" name="id_Plat'.$num.'" value=""><option>Seleccionar...</option>';

        $sql = "SELECT * FROM platillo WHERE Estado='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $Platillo.= '<option name="id_Plat'.$num.'" value="'.$row['id_Plat'].'">'.$row['nombre'].'</option>';
            }
        }
        $Platillo.='</select>
        <input type="number" min="1" class="pure-u-1-2 form-cant-Platillo" name="cant_'.$num.'" placeholder="Cantidad"/></div>';
        echo $Platillo;
        $this->con->close();
    }
     //--------------cargar platillos ya registrados en el combo
    public function cargarPlatillo($id_Comb){

        // ES IMPORTANTE CADA SELECT Y CADA INPUT TENGA UN NAME CONCATENABLE PARA DIFERENCIARLOS 
        $this->conectar();
        $num=1;
        $platillo="";
        $sql = "SELECT * FROM r_c_pl WHERE id_Comb=".$id_Comb;
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $platillo.='<div id="combo'.$num.'" class="pure-u-1 pure-u-md-1-3">
                <select class="pure-u-1-2 form-id-Platillo" name="id_Plat'.$num.'" value=""><option>Seleccionar...</option>';

                $sql1 = "SELECT * FROM platillo WHERE Estado='activo'";
                $result1 = $this->con->query($sql1);
                if ($result1->num_rows > 0) {
                    while($row1 = $result1->fetch_assoc()) {
                            $platillo.= '<option name="id_Plat'.$num.'" value="'.$row1['id_Plat'].'"';
                            if($row['id_Plat']==$row1['id_Plat']){$platillo.=' selected ';}
                            $platillo.='>'.$row1['nombre'].'</option>';
                    }
                }
                $platillo.='</select>

                <input type="number" min="1" class="pure-u-1-2 form-cant-Platillo" name="cant_'.$num.'" placeholder="Cantidad" value="'.$row['cant'].'"/></div>';
                $num++;
            }
            
        }
        setcookie ("contador", $num, 0, '/');
        echo $platillo;
        $this->con->close();
    }



}