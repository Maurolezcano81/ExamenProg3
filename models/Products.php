<?php

require_once './config/connection.php';


class Products
{
    private $db;

    public function __construct()
    {
        $this->db = new Connection();
    }

    public function getProducts()
    {
        $conn = $this->db->getConnection();

        $query = $query = "SELECT p.nombre, p.precio_venta, p.activo as activo, m.nombre AS marca, c.nombre AS categoria
        FROM productos p
        JOIN marcas m ON p.marcas_id = m.id
        JOIN categorias c ON p.categorias_id = c.id";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        $productos = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }

        return $productos;
    }

    public function updatePrices($id_category)
    {
        $conn = $this->db->getConnection();

        $query = "SELECT id, precio_venta FROM productos WHERE categorias_id = $id_category AND activo = 1";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $new_price = $row['precio_venta'] * 1.10;

            if ($new_price >= 10000) {
                $update_query = "UPDATE productos SET activo = 0 WHERE id = " . $row['id'];
            } else {
                $update_query = "UPDATE productos SET precio_venta = " . $new_price . " WHERE id = " . $row['id'];
            }

            $update_result = mysqli_query($conn, $update_query);

            if (!$update_result) {
                die("Error actualizando el producto con ID " . $row['id'] . ": " . mysqli_error($conn));
            }
        }

        return true;
    }
}
