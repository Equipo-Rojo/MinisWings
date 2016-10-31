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
        $cuenta= '
            <div class="table-responsive">
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th># Mesa</th>
                            <th>Cantidad</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Terminar</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $sql1 = "SELECT * FROM cuentas INNER JOIN orden ON cuentas.id_Cue=orden.id_Cue WHERE estado='Pedido' ORDER BY id_Ord ASC";
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
                                <tr><th>'.$row1['NumMesa'].'</th>
                                    <td>'.$row1['cantidad'].'</td>
                                    <td>'.$row2['nombre'].'</td>
                                    <td>'.$row1['tipo'].'</td>
                                    <th><i id="'.$row1['id_Ord'].'" class="fa fa-hand-pointer-o change-status" aria-hidden="true"></i></th>
                                </tr>';
                            }

                        }
                    }
    
        $cuenta.='
        </tbody>
                </table>
            </div>';

    
        echo $cuenta;
        $this->con->close();
    }
    
    //------------agregar cuenta
    public function ordenTerminada($id_Ord)
    {
        $this->conectar();
        $sql = "UPDATE orden SET estado='Terminada' Where id_Ord=".$id_Ord;
        $result = $this->con->query($sql);
        if($this->con->affected_rows){
            echo "Orden #".$id_Ord." Terminada";
        } 
        $this->con->close();
    }
}
    