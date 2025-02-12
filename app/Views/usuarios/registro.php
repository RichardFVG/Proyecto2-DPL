<?php
    // 1. Incluyo el archivo header.php para la 
    // estructura y la barra de navegación.
    require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Encabezado para indicar que el 
 usuario se encuentra en la sección de 
 registro. -->
<h1>Registro de Usuario</h1>

<!-- 3. Muestro un posible mensaje de error 
 si está definido en la variable $error. -->
<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php echo htmlspecialchars($error); ?>
    </p>
<?php endif; ?>

<!-- 4. Formulario que envía los datos al 
 método procesarRegistro del controlador de 
 usuario. -->
<form action="index.php?controller=usuario&action=procesarRegistro" 
method="POST">
    <!-- 5. Campo para el nombre del usuario, 
     marcado como obligatorio. -->
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <!-- 6. Campo para el email del usuario, 
     también obligatorio. -->
    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <!-- 7. Campo para la contraseña, encriptada 
     en el backend, requerida. -->
    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" required>

    <!-- 8. Checkbox para marcar si el usuario 
     desea ser admin. -->
    <label for="admin">Usuario Admin?</label>
    <input type="checkbox" name="admin" value="1">
    <br>
    <br>

    <!-- 9. Campo para la contraseña de administrador, 
     necesaria únicamente si se marca la casilla 
     anterior. -->
    <label for="admin_password">Contraseña Admin:</label>
    <input type="password" name="admin_password">
    <br><br>

    <!-- 10. Botón para enviar el formulario y 
     registrar al usuario. -->
    <button type="submit">Registrarse</button>
</form>

<!-- 11. Enlace para los usuarios que ya tienen cuenta, 
 les permite iniciar sesión. -->
<p>
    ¿Ya tienes una cuenta?
    <a href="index.php?controller=usuario&action=login">
        Inicia sesión aquí
    </a>.
</p>

<!-- 12. Enlace para volver a la página principal de 
 la tienda. -->
<p>
    <a href="index.php">Volver a la Tienda</a>
</p>

<?php
    // 13. Incluyo el archivo footer.php para cerrar la 
    // estructura HTML.
    require __DIR__ . '/../layout/footer.php';
?>
