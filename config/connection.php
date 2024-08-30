<?php


class Connection
{

    private $username = 'root';
    private $db = 'almacendb';
    private $pwd = '';
    private $port = '3306';
    private $host = 'localhost';
    public $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->pwd, $this->db, $this->port);

        if (!$this->conn) {
            die('Error al conectar a la base de datos' . mysqli_connect_error());
        }

        echo `Conectado a la base de datos: {$this->db} en el puerto: {$this->port}`;

    }

    public function getConnection(){
        return $this->conn;
    }
}
