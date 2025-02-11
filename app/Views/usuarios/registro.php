<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Registro de Usuario</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?controller=usuario&action=procesarRegistro" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" required>

    <!-- Nuevo campo para indicar si es admin -->
    <label for="admin">Usuario Admin?</label>
    <input type="checkbox" name="admin" value="1">
    <br>
    <br>

    <!-- Nuevo campo para la contraseña fija solo cuando se quiera crear un admin -->
    <!-- Esta contraseña fija es "000000". No es obligatorio llenarla si no se ha marcado el checkbox de admin -->
    <label for="admin_password">Contraseña Admin:</label>
    <input type="password" name="admin_password">

    <br><br>
    <button type="submit">Registrarse</button>
</form>
<p>¿Ya tienes una cuenta? <a href="index.php?controller=usuario&action=login">Inicia sesión aquí</a>.</p>

<!-- NUEVO ENLACE A LA TIENDA -->
<p><a href="index.php">Volver a la Tienda</a></p>
<?php require __DIR__ . '/../layout/footer.php'; ?>
