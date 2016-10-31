<?php

class orden
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
    public function listarCuentas()
    {
        $this->conectar();
        session_start();
        $id_em=$_SESSION['id'];
        $cuenta="";
        $sql = "SELECT * FROM cuentas WHERE Estatus='abierta' AND id_Em=".$id_em;
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $cuenta.= '
                <fieldset>
                    <legend>Mesa '.$row['NumMesa'].'</legend>
                    <button id="'.$row['id_Cue'].'" class="add-orden button-xlarge button-warning pure-button"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Orden</button>
                    <br/><br/>

                    <div class="table-responsive">
                        <table class="pure-table pure-table-horizontal">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Precio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $sql1 = "SELECT * FROM orden WHERE id_Cue=".$row['id_Cue'];
                            $result1 = $this->con->query($sql1);
                            if ($result1->num_rows > 0) {
                                while($row1 = $result1->fetch_assoc()) 
                                {
                                    switch($row1['tipo']){
                                        case 'platillo':                                    
                                           $sql2 = "SELECT * FROM platillo WHERE id_Plat=".$row1['id_Menu'];
                                           break;
                                        case 'combos':
                                            $sql2 = "SELECT * FROM combos WHERE id_Comb=".$row1['id_Menu'];
                                            break;
                                        case 'promos':
                                            $sql2 = "SELECT * FROM promos WHERE id_Promo=".$row1['id_Menu'];
                                            break;
                                    }
                                    $result2 = $this->con->query($sql2);
                                    if ($result2->num_rows > 0) {
                                        $row2 = $result2->fetch_assoc();
                                        $cuenta.='
                                        <tr>
                                            <td>'.$row1['cantidad'].'</td>
                                            <td>'.$row2['nombre'].'</td>
                                            <td>'.$row1['tipo'].'</td>
                                            <td>'.$row2['precio'].'</td>
                                            <th>'.$row1['estado'].'</th>
                                        </tr>';
                                    }
                                }
                            }
            
                $cuenta.='
                </tbody>
                        </table>
                    </div>
                </fieldset>';
            }
        }
    
        echo $cuenta;
        $this->con->close();
    }
    //------------Listar mesas
    public function listarMesas()
    {
        $this->conectar();
        $mesa="";
        $sql = "SELECT * FROM mesa WHERE Estatus='Libre' ORDER BY NumMesa";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $mesa.= '<option name="mesa" value="'.$row['id_Mesa'].'">'.$row['NumMesa'].'</option>';
            
            }
        }
    
        echo $mesa;
        $this->con->close();
    }
    //------------agregar cuenta
    public function nuevaCuenta($mesa, $status)
    {
        $this->conectar();
        session_start();
        $id=$_SESSION['id'];
        $sql = "INSERT INTO cuentas (Estatus, NumMesa, id_Em) VALUES('".$status."','".$mesa."',".$id.")";
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            $sql = "SELECT max(id_Cue) as id_Cue FROM cuentas";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) 
            {
                $result=$result->fetch_assoc();
                $sql = "INSERT INTO venta (id_Cue, Estado) VALUES('".$result['id_Cue']."','Abiert')";
                $result = $this->con->query($sql);
                if($this->con->affected_rows){
                    $sql = $sql = "UPDATE mesa SET Estatus='Ocupada' Where id_Mesa=".$mesa;
                    $this->conectar();
                    $result = $this->con->query($sql);
                }
                
            }   
        }      
        echo $mesa;
        $this->con->close();
    }

}
