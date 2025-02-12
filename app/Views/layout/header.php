<!DOCTYPE html>
<html lang="es">
<head>
    <!-- 1. Codificación de caracteres para 
     español y caracteres acentuados. -->
    <meta charset="UTF-8">
    
    <!-- 2. Meta viewport para adaptarse a 
     dispositivos móviles. -->
    <meta name="viewport" 
    content="width=device-width, initial-scale=1.0">
    
    <!-- 3. Título de la página, aparece en 
     la pestaña del navegador. -->
    <title>RFVG - MaxiSalud</title>
    
    <!-- 4. Incluyo la hoja de estilos 
     principal. -->
    <link rel="stylesheet" href="css/estilos.css">
    
    <!-- 5. Favicon para el sitio web. -->
    <link rel="icon" href="/img2/RFVG.png" 
    type="image/png">
</head>
<body>
    <!-- 6. Título principal con clase que 
     aplica animación. -->
    <h1 class="title-underline">
        Bienvenido a MaxiSalud: 
        Plataforma de Venta de Equipos Médicos
    </h1>

    <?php
    // 7. Verifico si la sesión no está iniciada, 
    // la inicio para gestionar el login/logout.
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <!-- 8. Compruebo si existe una sesión de 
     usuario con 'nombre_usuario'. -->
    <?php if (isset($_SESSION['nombre_usuario'])): ?>
        <p>
            <!-- 9. Muestro el nombre del usuario 
             logueado. -->
            Hola, <?php 
                echo htmlspecialchars(
                    $_SESSION['nombre_usuario']
                ); 
            ?> |

            <!-- 10. Enlace para cerrar sesión. -->
            <a href="index.php?controller=usuario&action=logout">
                Cerrar Sesión
            </a> |

            <!-- 11. Verifico si el usuario es 
             administrador para mostrar opciones 
             adicionales. -->
            <?php 
                if (
                    isset($_SESSION['admin']) && 
                    $_SESSION['admin'] == 1
                ): 
            ?>
                <!-- 11. Enlace para agregar producto, 
                 solo visible para admin. -->
                <a href="index.php?controller=producto&action=agregar">
                    Agregar Producto
                </a> | 

                <!-- 12. Enlace para listar y gestionar 
                 productos, disponible solo para 
                 admin. -->
                <a href="index.php?controller=producto&action=lista">
                    Gestionar Productos
                </a>
            <?php else: ?>
                <!-- 13. Si no es admin, muestro la 
                 opción de ver el carrito. -->
                <a href="index.php?controller=carrito&action=ver">
                    Mi Carrito
                </a>
            <?php endif; ?>
        </p>
    <?php else: ?>
        <!-- 14. Si no hay sesión iniciada, muestro 
         los enlaces para iniciar sesión o 
         registrarse. -->
        <p>
            <a href="index.php?controller=usuario&action=login">
                Iniciar Sesión
            </a> | 

            <a href="index.php?controller=usuario&action=registro">
                Registrarse
            </a>
        </p>
    <?php endif; ?>

    <!-- 15. Línea horizontal para separar el 
     encabezado del contenido. -->
    <hr>
