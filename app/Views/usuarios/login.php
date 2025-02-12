<?php
    // 1. Incluyo la cabecera (header.php) para 
    // la estructura básica de la página.
    require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Encabezado para el formulario de 
 inicio de sesión. -->
<h1>Iniciar Sesión</h1>

<!-- 3. Muestro un mensaje en verde si llega 
 un 'message' por la URL (p.ej., al registrarse 
 con éxito). -->
<?php if (isset($_GET['message'])): ?>
    <p style="color: green;">
        <?php 
            echo htmlspecialchars(
                $_GET['message']
            ); 
        ?>
    </p>
<?php endif; ?>

<!-- 4. Muestro un mensaje de error si la 
 variable $error está definida (p.ej., 
 credenciales incorrectas). -->
<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php 
            echo htmlspecialchars($error); 
        ?>
    </p>
<?php endif; ?>

<!-- 5. Formulario que envía los datos a la 
 acción 'procesarLogin' del controlador 
 'usuario'. -->
<form action="index.php?controller=usuario&action=procesarLogin" 
method="POST">
    <!-- 6. Campo para el correo electrónico, 
     marcado como obligatorio. -->
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>
    <br>

    <!-- 7. Campo para la contraseña, también 
     obligatorio. -->
    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" required>
    <br>

    <!-- 8. Botón para iniciar sesión, se 
     procesará en procesarLogin. -->
    <button type="submit">Iniciar Sesión</button>
</form>

<!-- 9. Enlace para aquellos que no tienen 
 cuenta y desean registrarse. -->
<p>
    ¿No tienes una cuenta?
    <a href="index.php?controller=usuario&action=registro">
        Regístrate aquí
    </a>
</p>

<!-- 10. Enlace para regresar a la página 
 principal de la tienda. -->
<p>
    <a href="index.php">Volver a la Tienda</a>
</p>

<?php
    // 11. Incluyo el footer, que cierra la 
    // estructura HTML.
    require __DIR__ . '/../layout/footer.php';
?>
