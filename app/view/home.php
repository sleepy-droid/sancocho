<?php
// Incluir el header.php que contiene la barra de navegación y el saludo al usuario
    include_once 'layouts/header.php'

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sancocho Reservas</title>
    <!-- Aquí podrías enlazar tus archivos CSS -->

</head>

<body>
    <header>
        
    </header>
    <div id="content">
        <!-- Contenido principal de tu página de inicio -->
        <h1>Bienvenido a Sancocho Restaurantes</h1>
        <p>Encuentra los mejores restaurantes y haz tus reservas fácilmente.</p>
        <?php include_once 'restaurantes/destacados.php' ?>
        <!-- Aquí podrías incluir más contenido como listas de restaurantes, ofertas especiales, etc. -->
    </div>

    <!-- Aquí podrías incluir un footer si tienes uno -->
    <?php 
    include_once $_SERVER['DOCUMENT_ROOT'] . '/sancocho/app/view/layouts/footer.php'; 
    //include_once 'layouts/footer.php';
    ?>
</body>

</html>