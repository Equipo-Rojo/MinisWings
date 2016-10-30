<?php

class Conexion
{
	    //Atributos globales. 
    private $host="";
    private $user="";
    private $pw="";
    private $db="miniisbd";
    private $con;
    
	public function __construct($datosServer) {
		include($datosServer);
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
            die("Error en conexión: " . mysqli_conect_error());
        }
    return $this->con;    
    }
}

?>