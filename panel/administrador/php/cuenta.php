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
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $cuenta.= '
                <fieldset>
                    <legend>Cuenta '.$row['id_Cue'].'</legend>
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
            while($row1 = $result1->fetch_assoc()) {
                            $cuenta.= '<tr>
                                    <td>'.$row1['cantidad'].'</td>
                                    <td>Promo 1</td>
                                    <td>Promoción</td>
                                    <td>70.00</td>
                                    <th>'.$row1['estado'].'</th>
                                </tr>';
                            }
                        }
                $cuenta.='</tbody>
                        </table>
                    </div>
                </fieldset>';
            }
        }
        echo $cuenta;
        $this->con->close();
    }

}
