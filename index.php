<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pancho-Mall</title>
    <link rel="stylesheet" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&display=swap" rel="stylesheet">

</head>

<body>

    <?php


    /*
Pancho el kiosquero, quiere actualizar sus precios, ayudemos a Pancho con php.
Levantar el script con la base de datos, y los datos correspondientes.
1 – Desarrollar en php un listado del mismo donde pueda ver las siguientes columnas:
3 puntos
Nombre_producto, precio, marca y categoria (Solo se deben ver estos datos)
2 – Desarrollar un formulario donde se seleccione una categoria e incremente el precio de estos 
productos un 10%, si el precio del producto incrementado supera los 10 mil pesos, automaticamente
el sistema dara la baja logica teniendo en cuenta el campo activo. (No se debe mostrar en la lista).
5 puntos
3 –  #CFA79F  #C6D9B8  #B8D7D9
*/

    require_once './models/Products.php';
    require_once './models/Categories.php';
    $productsInstace = new Products();
    $listProducts = $productsInstace->getProducts();

    $categoryInstance = new Category();
    $listCategories = $categoryInstance->getCategories();


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria_id'])) {
        $category_id = intval($_POST['categoria_id']);
        
        if ($productsInstace->updatePrices($category_id)) {
            $message = "Precios actualizados correctamente.";
        } else {
            $message = "Error al actualizar los precios.";
        }
    }
    ?>


    <div class="container__table">
        <div class="container__button">
            <button id="toggleModal">Modificar Precio</button>
        </div>

        <table class="">
            <thead>
                <tr>
                    <th colspan="4">LISTADO DE PRODUCTOS</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if (!empty($listProducts)) {
                    foreach ($listProducts as $product) {
                        if($product['activo'] == 1){
                            echo '<tr>';
                            echo '<td>' . $product['nombre'] . '</td>';
                            echo '<td>' . $product['precio_venta'] . '</td>';
                            echo '<td>' . $product['marca'] . '</td>';
                            echo '<td>' . $product['categoria'] . '</td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    echo "No se encontraron productos.";
                }


                ?>
            </tbody>
        </table>
    </div>

    <div id="priceModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Modificar Precios por Categoría</h2>
            <form action="index.php" method="POST">
                <div class="select__container">
                <label for="categoria">Seleccionar Categoría:</label>
                <select name="categoria_id" id="categoria">
                    <?php foreach ($listCategories as $category): ?>
                        <option value="<?php echo $category['id']; ?>">
                            <?php echo $category['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                </div>
               
                <button class="increment__button" type="submit">Incrementar 10%</button>
            </form>
        </div>
    </div>


    <script src="./assets/js/index.js"></script>
</body>

</html>