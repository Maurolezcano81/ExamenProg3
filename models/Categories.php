<?php

require_once './config/connection.php';

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
    }

    public function getCategories()
    {
        $conn = $this->db->getConnection();
        
        $query = "SELECT id, nombre FROM categorias";
        
        $result = mysqli_query($conn, $query);
        
        if (!$result) {
            die("Error en la consulta de categorías: " . mysqli_error($conn));
        }

        $categorias = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $categorias[] = $row;
        }

        return $categorias;
    }
}
