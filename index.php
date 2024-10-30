<!DOCTYPE html>
<html lang="en">
<?php include 'conexion.php'; ?>
<?php include 'cargar_productos.php'; ?>
<?php require_once 'config.php'; ?>


<!-- Agrega aquí más secciones si es necesario -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postres</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
         /* Estilos para la tarjeta de producto */
         .card-product {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 8px;
            text-align: center;
            margin: 4px; /* Reduce el margen aún más */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            flex: 1; /* Permite que las tarjetas crezcan uniformemente */
            max-width: calc(25% - 8px); /* Tamaño más pequeño (4 en una fila) */
        }

        .card-product:hover {
            transform: scale(1.05); /* Efecto al pasar el ratón */
        }

        .container-img img {
            max-width: 100%;
            height: auto;
            border-radius: 8px; /* Bordes redondeados en la imagen */
        }

        .content-card-product {
            margin-top: 8px;
        }

        .content-card-product h3 {
            font-size: 1.2em; /* Reduce el tamaño de la fuente */
            margin: 4px 0; /* Reduce el margen */
        }

        .add-cart {
            font-size: 1.5em;
            color: #5cb85c; /* Color del icono */
            cursor: pointer;
        }

        .price {
            font-weight: bold;
            color: #d9534f; /* Color destacado para el precio */
            font-size: 1em; /* Reduce el tamaño del precio */
            margin-top: 4px; /* Reduce el margen */
        }

        /* Nueva sección para el contenedor de productos */
        .container-products {
            display: flex; /* Utilizar Flexbox */
            flex-wrap: nowrap; /* Mantener las tarjetas en una línea */
            justify-content: space-between; /* Espaciado uniforme entre tarjetas */
            margin: 0 -4px; /* Ajustar los márgenes laterales */
        }

        .menu-toggle {
    font-size: 24px; /* Tamaño de la hamburguesa */
    cursor: pointer;
    display: none; /* Ocultar por defecto */
}

.nav-menu {
    display: none; /* Ocultar menú por defecto */
    position: fixed;
    top: 0;
    right: 0;
    width: 250px; /* Ancho de la ventana */
    height: 100%; /* Alto completo */
    background-color: #f0f0f0; /* Fondo gris claro */
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5); /* Sombra */
    z-index: 1000; /* Asegurar que esté encima de otros elementos */
    padding: 20px; /* Espaciado interno */
}

.nav-menu ul {
    list-style-type: none; /* Sin viñetas */
    padding: 0; /* Sin padding */
}

.nav-menu ul li {
    padding: 20px 0; /* Espaciado entre elementos aumentado */
    border-bottom: 1px solid #ccc; /* Línea separadora */
}

.nav-menu ul li:last-child {
    border-bottom: none; /* Quitar la línea del último elemento */
}

.nav-menu ul li a {
    font-size: 18px; /* Tamaño de fuente ajustado */
    color: black; /* Color del texto */
    text-decoration: none; /* Sin subrayado */
    display: block; /* Hacer que el área clickeable sea toda la fila */
}

.nav-menu .close {
    font-size: 20px; /* Tamaño de la X para cerrar */
    cursor: pointer;
    float: right; /* Cerrar a la derecha */
}

@media (max-width: 768px) {
    .menu-toggle {
        display: block; /* Mostrar solo en móviles */
    }
}

        
    
    </style>
</head>
<body>

<header>
    <div class="container-hero">
        <div class="container hero">
            <div class="customer-support">
                <i class="fa-solid fa-headset"></i>
                <div class="content-custumer-support">
                    <span class="text">Soporte al cliente</span>
                    <span class="number">318 5643394</span>
                </div>
            </div>
            <div class="container-logo" style="display: flex; justify-content: center; align-items: center; text-align: center; margin: 1rem 0;">
                <h1 class="logo">
                    <a href="/" style="text-decoration: none; color: var(--dark-color); font-size: 3rem;">Postres Mora</a>
                </h1>
            </div>



            <div class="container-user">
                <!-- Enlace al perfil del usuario -->
                <a href="/postres/entrar.php" class="user-link">
                    <i class="fa-solid fa-user"></i>
                </a>
                <!-- Enlace al carrito de compras -->
                <a href="#" id="cart-link" class="cart-link">
                    <i class="fa-solid fa-basket-shopping"></i>
                   
                </a>
            </div>
        </div>
    </div>

    <div class="container-navbar">
        <nav class="navbar container">
            
        
            <ul class="menu">
                <li><a href="#banner">Inicio</a></li>
                <li><a href="#top-products">Mejores Productos</a></li>
                <li><a href="#top-categories">Mejores categorías</a></li>
                <li><a href="#specials">Especiales</a></li>
                <li><a href="#blogs">Blog</a></li>
                <li><a href="/postres/entraradmi.php">Administración</a></li>
            </ul>

           
        </nav>
    </div>
</header>

<div class="menu-toggle" id="menu-toggle">
    &#9776; <!-- Icono de hamburguesa -->
</div>
<div class="nav-menu" id="nav-menu">
    <span class="close" id="close-menu">&times;</span>
    <ul>
        <li><a href="#banner">Inicio</a></li>
        <li><a href="#top-products">Mejores Productos</a></li>
        <li><a href="#top-categories">Mejores Categorías</a></li>
        <li><a href="#specials">Especiales</a></li>
        <li><a href="#blogs">Blog</a></li>
        <li><a href="/postres/entraradmi.php">Administración</a></li>
    </ul>
</div>


<!-- Modal del Carrito -->
<style>
        /* Estilos del modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Mantener en la pantalla */
            z-index: 1000; /* Encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%; /* Ancho completo */
            height: 100%; /* Alto completo */
            overflow: auto; /* Habilitar scroll si es necesario */
            background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente */
        }

        /* Contenido del modal */
        .modal-content {
            background-color: #f5f5dc; /* Beige claro */
            margin: 10% auto; /* Centrando el modal */
            padding: 20px; /* Espaciado interno */
            border: 1px solid #ccc; /* Borde gris claro */
            border-radius: 10px; /* Bordes redondeados */
            width: 90%; /* Ancho del modal */
            max-width: 500px; /* Ancho máximo */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); /* Sombra */
            text-align: center; /* Centrar texto */
            font-size: 1.2em; /* Tamaño de fuente general más grande */
        }

        /* Botón de cerrar */
        .close {
            color: #aaa; /* Color del texto */
            float: right; /* A la derecha */
            font-size: 1.5em; /* Tamaño de fuente para el botón de cerrar */
            font-weight: bold; /* Negrita */
        }

        .close:hover,
        .close:focus {
            color: black; /* Color al pasar el mouse */
            text-decoration: none; /* Sin subrayado */
            cursor: pointer; /* Cambia el cursor */
        }

        /* Títulos y texto */
        h2 {
            color: #4b3d24; /* Color marrón oscuro */
            margin-bottom: 20px; /* Margen inferior */
            font-size: 1.5em; /* Tamaño de fuente del título */
        }

        #cart-total {
            font-weight: bold; /* Negrita */
            margin-top: 20px; /* Margen superior */
        }

        /* Estilos de la lista de productos */
        #cart-items {
            list-style-type: none; /* Sin viñetas */
            padding: 0; /* Sin padding */
            text-align: left; /* Alinear productos a la izquierda */
            margin: 0; /* Sin margen */
        }

        #cart-items li {
            padding: 10px; /* Espaciado interno */
            border-bottom: 1px solid #ddd; /* Línea divisoria */
        }

        /* Botón de finalizar compra */
        .finalizar-compra {
            display: inline-block; /* Mostrar como bloque */
            background-color: #d2b48c; /* Color beige */
            color: white; /* Texto blanco */
            padding: 10px 20px; /* Espaciado */
            text-align: center; /* Centrar texto */
            text-decoration: none; /* Sin subrayado */
            border-radius: 5px; /* Bordes redondeados */
            margin-top: 15px; /* Margen superior */
            transition: background-color 0.3s; /* Transición suave */
            font-size: 1.2em; /* Tamaño de fuente del botón */
        }

        .finalizar-compra:hover {
            background-color: #c2a89a; /* Color más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

<!-- Modal del Carrito -->
<div id="cart-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Carrito de Compras</h2>
        <ul id="cart-items">
            <!-- Los productos se agregarán aquí dinámicamente -->
            
        </ul>
        <p id="cart-total">Total: $0000</p>

        <a href="formulario.php" class="finalizar-compra">Finalizar Compra</a>
    </div>
</div>

<script>
    // Aquí podrías agregar el código para abrir y cerrar el modal
    const modal = document.getElementById("cart-modal");
    const span = document.getElementsByClassName("close")[0];

    // Función para abrir el modal
    function openModal() {
        modal.style.display = "block";
    }

    // Función para cerrar el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cerrar el modal al hacer clic fuera de él
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    // Para abrir el modal, llama a openModal()
    // openModal();
</script>

       

<!-- El resto del contenido HTML aquí... -->
<section id="banner" class="banner">
    <div class="content-banner">
        <p>Postres Deliciosos</p>
        <h2>100% Naturales <br>Exquisitos!</h2>
        <a href="<?= $_ENV['APP_URL'] ?>/postres/entrar.php">Registrate para realizar tu pedido</a>
    </div>
</section>

<main class="main-content">
    <section id="top-categories" class="container container-features">
        <div class="card-feature">
            <i class="fa-solid fa-cake-candles"></i>
            <div class="feature-content">
                <span>DESDE 2023</span>
                <p>Desde 2023 deleitando el paladar de los hogares caleños!</p>
            </div>
        </div>
        <div class="card-feature">
            <i class="fa-regular fa-clock"></i>
            <div class="feature-content">
                <span>DOMICILIOS GRATIS</span>
                <p>Entregas a domicilios en Cali, pago CONTRA ENTREGA</p>
            </div>
        </div>
        <div class="card-feature">
            <i class="fa-regular fa-calendar"></i>
            <div class="feature-content">
                <span>HORARIOS DE ATENCIÓN</span>
                <p>Nos encontramos prestando nuestros servicios desde 9am hasta 6pm</p>
            </div>
        </div>
        <div class="card-feature">
            <i class="fa-solid fa-headphones"></i>
            <div class="feature-content">
                <span>SERVICIO AL CLIENTE</span>
                <p>Teléfono: 318 5643394</p>
            </div>
        </div>
    </section>

    <section id="top-categories" class="container top-categories">
        <h1 class="heading-1">Mejores Categorías</h1>
        <div class="container-categories">
            <div class="card-category category-moca">
                <p>Torta De Maracuyá</p>
                <span>Media Libra</span>
                
               
            </div>
            <div class="card-category category-expreso">
                <p>Torta De Chocolate</p>
                <span> Media Libra</span>
                
            </div>
            <div class="card-category category-capuchino">
                <p>Torta De Mora</p>
                <span>Media Libra</span>
                
            </div>
        </div>
    </section>

        
        <?php
include 'conexion.php';

// Obtener productos de la base de datos
$sql = "SELECT name, price, image FROM postre"; // Asegúrate de que esta consulta refleje la estructura de tu base de datos
$result = $conexion->query($sql);
?>

<section id="top-products" class="container top-products">
    <h1 class="heading-1" style="margin-bottom: 20px;">Mejores Productos</h1>
    <div class="container-products">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card-product">
                <div class="container-img">
                    <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="350px" height="350px" />
                </div>
                <div class="content-card-product">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <span class="add-cart">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </span>
                    <p class="price">$<?= htmlspecialchars($row['price']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>

        
        

    <section class="gallery">
        <img src="img/MOSAICO (1).jfif" alt="Gallery Img1" class="gallery-img-1">
        <img src="img/MOSAICO CHOCOLATE.jfif" alt="Gallery Img2" class="gallery-img-2">
        <img src="img/MOSAICO LIMON.jfif" alt="Gallery Img3" class="gallery-img-3">
        <img src="img/MOSAICO.jfif" alt="Gallery Img4" class="gallery-img-4">
        <img src="img/MOSAICO.jpg" alt="Gallery Img5" class="gallery-img-5">
    </section>

    
     
    <?php
include 'conexion.php';

// Obtener productos de la base de datos
$sql = "SELECT name, price, image FROM especiales"; // Asegúrate de que esta consulta refleje la estructura de tu base de datos
$result = $conexion->query($sql);

?>

<section id="top-products" class="container top-products">
    <section id="specials" class="container top-products">
    <h1 class="heading-1" style="margin-bottom: 20px;">Especiales</h1>
    <div class="container-products">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card-product">
                <div class="container-img">
                    <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="350px" height="350px" />
                </div>
                <div class="content-card-product">
                    <h3><?= htmlspecialchars($row['name']) ?></h3>
                    <span class="add-cart">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </span>
                    <p class="price">$<?= htmlspecialchars($row['price']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    
    

    <h1 class="heading-1" style="margin-bottom: 30px;"></h1>
<section class=" container blogs">

        <section id="blogs" class="blogs">
            <h1 class="heading-1" style="margin-bottom: 20px;">Últimos blogs</h1>
            
            
        </section>
    

        <div class="container-blogs">
           <div class="card-blogs">
            <div class="container-img">
                <img src="img/BLOG 1.jfif" alt="Imagen Blog 1">
                <div class="button-group-blog">
                 <a href="<?= $_ENV['APP_URL'] ?>/postres/destino2.php" target="_blank" style="text-decoration: none;">
                    <span>
                     
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    
                </div>
            </div>
            <div class="content-blog">
                <h3>Bienvenidos a Postres Mora</h3>
                <span>6/09/24</span>
                <p>
                En nuestro rincón dulce, encontrarás una deliciosa variedad de postres hechos con amor y dedicación. Desde cupcakes exquisitos hasta tortas irresistibles, cada bocado es una celebración de sabor. Gracias por visitar, ¡esperamos que disfrutes de nuestras creaciones tanto como nosotros disfrutamos haciéndolas! 
                </p>

                <a href="destino2.php" class="btn-read-more"> Leer más</a>

    

            </div>
           </div>


           <div class="card-blogs">
            <div class="container-img">
                <img src="img/BLOG 1.jfif" alt="Imagen Blog 2">
                <div class="button-group-blog">
                    <a href="<?= $_ENV['APP_URL'] ?>/postres/destino3.php" target="_blank" style="text-decoration: none;">
                    <span>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                   
                </div>
            </div>
            <div class="content-blog">
                <h3>¡Receta especial de Fresas con Crema! </h3>
                <span>7/09/24</span>
                <p>
                Este dulce clásico combina fresas jugosas con una cremosa y suave mezcla que te hará sonreír con cada bocado. Perfecto para cualquier ocasión, este postre es una verdadera delicia que resalta la frescura de las frutas y la indulgencia de la crema. ¡Disfruta preparándolo tanto como nosotros disfrutamos crearlo para ti!
                </p>

                <a href="destino3.php" class="btn-read-more"> Leer más</a>


                
            </div>
           </div>

           <div class="card-blogs">
            <div class="container-img">
           
                <img src="img/BLOG 1.jfif" alt="Imagen Blog 3">
                <div class="button-group-blog">
                 <a href="<?= $_ENV['APP_URL'] ?>/postres/destino.php" target="_blank" style="text-decoration: none;">
                    <span>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    
                </div>
            </div>
            <div class="content-blog">
                <h3>
                 ¡Receta de Bizcocho de Limón y Merengue!</h3>
                <span>7/09/24</span>
                <p>
                Este exquisito postre combina un bizcocho ligero y esponjoso con un delicado merengue que se derrite en tu boca. La frescura del limón y la suavidad del merengue crean un equilibrio perfecto de sabores que te conquistará en cada bocado. ¡Prepárate para disfrutar de una experiencia dulce y refrescante, que hemos creado con mucho cariño para ti!
                </p>
                
                    <a href="destino.php" class="btn-read-more"> Leer más</a>
                
            </div>
           </div>
        </div>
    </section>
   </main>


   


   

       

   <footer class="footer">
    <div class="container container-footer">
        <div class="menu-footer">

            <div class="contact-info">
                <p class="tittle-footer">Información Del Contacto</p>
                <ul>
                    <li>Dirección: Calle 72 H #28 B 1- 21 Barrio Comuneros, Cali                    </li>
                    <li>Télefono:  318 5643394</li>
                    <li>Email: postresmora053@gmail.com</li>
                </ul>
                
            </div>

            <div class="information">
                <p class="tittle-footer">Información</p>
                <ul>
                   
                    <li><a href="destino4.php">Politicas de Privacidad</a></li>
                    
                </ul>
            </div>
           
            

            
        </div>

       
    </div>
   </footer>

    <script
       src="https://kit.fontawesome.com/81581fb069.js"
       crossorigin="anonymous"
    ></script>

    


    
</body>
</html>
        


<script src="https://kit.fontawesome.com/81581fb069.js" crossorigin="anonymous"></script>
<script>
    console.log("inicio");
</script>
<script src="script.js"></script>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');
    const closeMenu = document.getElementById('close-menu');

    menuToggle.addEventListener('click', function() {
        navMenu.style.display = 'block';
    });

    closeMenu.addEventListener('click', function() {
        navMenu.style.display = 'none';
    });

    // Cerrar el menú al hacer clic fuera de él
    window.addEventListener('click', function(event) {
        if (event.target === navMenu) {
            navMenu.style.display = 'none';
        }
    });
</script>




</body>
</html>