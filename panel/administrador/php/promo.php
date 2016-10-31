<?php

class promo
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
    
    //--------------- Listar promos
    public function listarpromos()
    {
        $this->conectar();
        $promo="";
        $sql = "SELECT * FROM promos WHERE Estado='activo'";
        $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                        $promo .= '<tr>
                        <td class="">'.$row['nombre'].'</td>
                        <td class="">'.$row['Descripcion'].'</td> 
                        <td class="">'.$row['precio'].'</td>
                        <td class="">'.$row['Fecha'].'</td>
                        <td class=""><i id="'.$row['id_Promo'].'" class="fa fa-pencil-square-o edite-promo" aria-hidden="true"></i></td>
                        <td class=""><i id="'.$row['id_Promo'].'" class="fa fa-trash delete-promo" aria-hidden="true"></i></td> 
                        </tr>';
                }
            }
            echo $promo;
            $this->con->close();
    }
        //--------------- Eliminar promo
    public function eliminarPromo($id)
    {   
        $this->conectar();
        $sql = "UPDATE promos SET Estado='inactivo' WHERE id_Promo='".$id."'";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Exito";
        }        
        $this->con->close();
    }
    //--------------Listar Combos y platillo
    public function listarCombos($num){
        $this->conectar();
        $Promo='<div id="combo'.$num.'" class="pure-u-1 pure-u-md-1-3"><select class="pure-u-1-2 form-add-Promo" name="id_Inv" value=""><option>Seleccionar...</option>';

        $sql = "SELECT * FROM combos WHERE Estado='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                    $Promo.= '<option name="id_Promo" value="'.$row['id_Comp'].'">'.$row['nombre'].'</option>';
            }
        }
        $Promo.='</select></div>';
        echo $Promo;
        $this->con->close();
    }

    //--------------- Agregar ppromo
    public function agregarpromo($datosCombo, $camposCombo,$datosPromo, $camposPromo)
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
            echo 'modulos/menu/promo.php';
        }      
        $this->con->close();
        */
        echo 'modulos/menu/promo.php';
    }
}