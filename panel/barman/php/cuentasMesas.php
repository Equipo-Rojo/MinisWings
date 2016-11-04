<?php

class cuentaMesa
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
        $sql = "SELECT * FROM cuentas WHERE Estatus='Por pagar'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $cuenta.= '';
                            $sql1 = "SELECT * FROM cuentas WHERE Estatus='Por pagar'";
                            $result1 = $this->con->query($sql1);
                            if ($result1->num_rows > 0) {
                                while($row1 = $result1->fetch_assoc()) 
                                {
                                    $cuenta.='
                                    <tr>
                                        <td>'.$row1['NumMesa'].'</td>
                                        <td>'.$row1['Estatus'].'</td>
                                        <td>$ '.number_format($row1['Total'],2).'</td>
                                        <th><i id="'.$row1['id_Cue'].'" class="fa fa-hand-pointer-o pagar" aria-hidden="true"></i></th>
                                        <th><i id="'.$row1['id_Cue'].'" class="fa fa-hand-pointer-o cortesia" aria-hidden="true"></i></th>
                                    </tr>';
                                }

                                
                            }
            
                $cuenta.='
                </tbody>
                        </table>
                    </div>';
            }
        }
    
        echo $cuenta;
        $this->con->close();
    }
    //--------------------------------
       public function Cortesia($id_Cue)
    {
        $this->conectar();
        $total=0;
        $pagar=1;
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
                   
                    if($row1['estado']!="Cancelado"){
                         $total+=($row1['cantidad']*$row2['precio']);
                    }
                    if($row1['estado']!="Completo" && $row1['estado']!="Cancelado"){
                        $pagar=0;
                    }
                }
            }
        }
        if($pagar>0){
            $sql = "UPDATE cuentas SET Total=".$total.", Estatus='Cortesia' WHERE id_Cue=".$id_Cue;
            $result = $this->con->query($sql);
            $sql="SELECT * FROM cuentas WHERE id_Cue=".$id_Cue;
            $result = $this->con->query($sql);
            $result=$result->fetch_assoc();
            $sql = $sql = "UPDATE mesa SET Estatus='Libre' WHERE NumMesa=".$result['NumMesa'];
            $result = $this->con->query($sql);
            $fecha=date("Y-m-d H:i:s");    
            $sql = $sql = "UPDATE venta SET Estado='Cortesia', Total_Cierre=".$total.", Fecha_Cierre='".$fecha."' WHERE id_Cue=".$id_Cue;
            $result = $this->con->query($sql);

            echo "Se registró pago con cortesia ";   
        }else{
            echo "No se puede pagar!! Aun hay ordenes pendientes";
        }
        $this->con->close();
    }
    //----------------------------------
       public function Pagar($id_Cue)
    {
        $this->conectar();
        $total=0;
        $pagar=1;
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
                   
                    if($row1['estado']!="Cancelado"){
                         $total+=($row1['cantidad']*$row2['precio']);
                    }
                    if($row1['estado']!="Completo" && $row1['estado']!="Cancelado"){
                        $pagar=0;
                    }
                }
            }
        }
        if($pagar>0){
            $sql = "UPDATE cuentas SET Total=".$total.", Estatus='Pagada' WHERE id_Cue=".$id_Cue;
            $result = $this->con->query($sql);
            $sql="SELECT * FROM cuentas WHERE id_Cue=".$id_Cue;
            $result = $this->con->query($sql);
            $result=$result->fetch_assoc();
            $sql = $sql = "UPDATE mesa SET Estatus='Libre' WHERE NumMesa=".$result['NumMesa'];
            $result = $this->con->query($sql);
            $fecha=date("Y-m-d H:i:s");    
            $sql = $sql = "UPDATE venta SET Estado='Pagada', Total_Cierre=".$total.", Fecha_Cierre='".$fecha."' WHERE id_Cue=".$id_Cue;
            $result = $this->con->query($sql);

            echo "Se registró pago con exito";   
        }else{
            echo "No se puede pagar!! Aun hay ordenes pendientes";
        }
        $this->con->close();
    }
}