<?php
// Conectar a la base de datos

require_once 'config.php';

$conn = getDbConnection();

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener todos los postres
$sql = "SELECT * FROM tarjetas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Ajusta la ruta según tu estructura -->
</head>
<body>

<section id="top-products" class="container top-products">
    <h1 class="heading-1" style="margin-bottom: 20px;">Mejores Productos</h1>
    
    <div class="container-options">
        <!-- Aquí puedes añadir filtros u opciones si deseas -->
    </div>
    <div class="container-products">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card-product">';
                echo '<div class="container-img">';
                echo '<img src="imagenes/' . $row['imagen'] . '" alt="' . $row['nombre'] . '" width="350px" height="350px" />';
                echo '</div>';
                echo '<div class="content-card-product">';
                echo '<h3>' . $row['nombre'] . '</h3>';
                echo '<span class="add-cart">';
                echo '<i class="fa-solid fa-basket-shopping"></i>';
                echo '</span>';
                echo '<p class="price">$' . number_format($row['precio'], 2) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay postres disponibles.";
        }
        ?>
    </div>
</section>

<section class="gallery">
    <img src="img/MOSAICO (1).jfif" alt="Gallery Img1" class="gallery-img-1">
    <img src="img/MOSAICO CHOCOLATE.jfif" alt="Gallery Img2" class="gallery-img-2">
    <img src="img/MOSAICO LIMON.jfif" alt="Gallery Img3" class="gallery-img-3">
    <img src="img/MOSAICO.jfif" alt="Gallery Img4" class="gallery-img-4">
    <img src="img/MOSAICO.jpg" alt="Gallery Img5" class="gallery-img-5">
</section>

<section id="specials" class="container special"> 
    <h1 class="heading-1" style="margin-bottom: 20px;">Especiales</h1>
    
    <div class="container-products">
        <!-- Aquí puedes añadir los productos especiales o dejarlo como está -->
    </div>
</section>

<?php
$conn->close();
?>

</body>
</html>
