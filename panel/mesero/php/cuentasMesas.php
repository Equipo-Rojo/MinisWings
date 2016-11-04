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
}