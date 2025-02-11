<!-- Views/layout/header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- META VIEWPORT PARA RESPONSIVIDAD -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma Médica</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="icon" href="/img2/RFVG.png" type="image/png">
</head>
<body>
    <h1 class="title-underline">Bienvenido a MaxiSalud: Plataforma de Venta de Equipos Médicos</h1>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    <?php if (isset($_SESSION['nombre_usuario'])): ?>
        <p>Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?> | 
        <a href="index.php?controller=usuario&action=logout">Cerrar Sesión</a> | 
        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
            <a href="index.php?controller=producto&action=agregar">Agregar Producto</a> | 
            <a href="index.php?controller=producto&action=lista">Gestionar Productos</a>
        <?php else: ?>
            <a href="index.php?controller=carrito&action=ver">Mi Carrito</a>
        <?php endif; ?>
        </p>
    <?php else: ?>
        <p><a href="index.php?controller=usuario&action=login">Iniciar Sesión</a> | 
        <a href="index.php?controller=usuario&action=registro">Registrarse</a></p>
    <?php endif; ?>
    <hr>
