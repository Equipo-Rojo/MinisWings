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
    //--------------- Listar cuentas
    public function listarCuentas()
    {
        $this->conectar();
        session_start();
        $id_em=$_SESSION['id'];
        $cuenta="";
        $sql = "SELECT * FROM cuentas WHERE Estatus='Abierta' AND id_Em=".$id_em;
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $cuenta.= '
                <fieldset>
                    <legend>Mesa '.$row['NumMesa'].'</legend>
                    <button id="'.$row['id_Cue'].'" class="add-orden button-xlarge button-warning pure-button"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Orden</button>
                    <button id="'.$row['id_Cue'].'" class="edite-cuenta pure-button button-secondary"><i class="fa ffa-pencil" aria-hidden="true"></i> Editar cuenta</button>
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
                                            <td>$ '.number_format($row2['precio'],2).'</td>
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
                $sql = "INSERT INTO venta (id_Cue, Estado) VALUES('".$result['id_Cue']."','Abierta')";
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
    //--------------- Listar cuentas
    public function listarMenu()
    {
        $this->conectar();
        $menu="";
        $sql = "SELECT * FROM platillo WHERE Estado='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $menu.= '<option value="platillo-'.$row['id_Plat'].'">'.$row['nombre'].'</option>';
            }
        }
        $sql = "SELECT * FROM combos WHERE Estado='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $menu.= '<option value="combos-'.$row['id_Comb'].'">Combo '.$row['nombre'].'</option>';
            }
        }
        $sql = "SELECT * FROM promos WHERE Estado='activo'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $menu.= '<option  value="promos-'.$row['id_Promo'].'">Promoción  '.$row['nombre'].'</option>';
            }
        }
    
        echo $menu;
        $this->con->close();
    }
    public function nuevaOdren($id_Cue, $id, $tipo, $cantidad){
        $this->conectar();
        $sql = "INSERT INTO orden (id_Cue, id_Menu, tipo, cantidad,estado) VALUES(".$id_Cue.",".$id.",'".$tipo."',".$cantidad.",'Pedido')";
        $result = $this->con->query($sql);
  
        if($this->con->affected_rows){
            switch($tipo){
                case 'platillo':                                    
                   $sql2 = "SELECT * FROM r_pl_in WHERE id_Plat=".$id;
                   break;
                case 'combos':
                    $sql2 = "SELECT id_Inv, r_pl_in.cant as cant1, r_c_pl.cant as cant2 FROM r_c_pl INNER JOIN r_pl_in ON r_c_pl.id_Plat=r_pl_in.id_Plat WHERE id_Comb=".$id;
                    break;
                case 'promos':
                    $sql2 = "SELECT id_Inv, r_pl_in.cant as cant1, r_pr_pl.cant as cant2 FROM r_pr_pl INNER JOIN r_pl_in ON r_pr_pl.id_Plat=r_pl_in.id_Plat WHERE id_Prom=".$id;
                    break;
            }

            $result2 = $this->con->query($sql2);
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) 
                {
                    if($tipo=="platillo"){
                        $sql3 = "UPDATE inventario SET cantidad=(cantidad-".($row2['cant']).")  WHERE id_Inv=".$row2['id_Inv'];
                    }else{
                        $sql3 = "UPDATE inventario SET cantidad=(cantidad-".($row2['cant1']*$row2['cant2']).")  WHERE id_Inv=".$row2['id_Inv'];
                    }
                    $result3 = $this->con->query($sql3);
                }
            }
            echo "Exito!! Orden en espera";
        }      
        $this->con->close();

    }
    //--------------- Listar cuentas
    public function listarOrdenes($id_Cue)
    {
        $this->conectar();

        $orden='<div class="table-responsive">
                    <table class="pure-table pure-table-horizontal">
                        <thead>
                            <tr>
                                <th>Cant</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>';
        $sql1 = "SELECT * FROM orden WHERE id_Cue=".$id_Cue;
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
                    $orden.='
                    <tr>
                        <td>'.$row1['cantidad'].'</td>
                        <td>'.$row2['nombre'].'</td>
                        <td>'.$row1['tipo'].'</td>
                        <td>$ '.number_format($row2['precio'],2).'</td>
                        <td>
                            <select id="orden" class="pure-u-1-2 form-edite" name="orden" value="">
                                <option name="'.$row1['id_Ord'].'" ';if($row1['estado']=='Pedido'){$orden.=" selected ";} $orden.='>Pedido</option>
                                <option name="'.$row1['id_Ord'].'" ';if($row1['estado']=='Preparando'){$orden.=" selected ";} $orden.='>Preparando</option>
                                <option name="'.$row1['id_Ord'].'" ';if($row1['estado']=='Listo'){$orden.=" selected ";} $orden.='>Listo</option>
                                <option name="'.$row1['id_Ord'].'" ';if($row1['estado']=='Servido'){$orden.=" selected ";} $orden.='>Servido</option>
                                <option name="'.$row1['id_Ord'].'" ';if($row1['estado']=='Cancelado'){$orden.=" selected ";} $orden.='>Cancelado</option>
                            </select>
                        </td>
                    </tr>';
                }
            }
        }
            
        $orden.='
        </tbody>
        </table>';
       
        echo $orden;
        $this->con->close();
    }

}
