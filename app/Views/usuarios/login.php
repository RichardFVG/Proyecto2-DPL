<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Iniciar Sesión</h1>

<?php if (isset($_GET['message'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
<?php endif; ?>

<?php if(isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action="index.php?controller=usuario&action=procesarLogin" method="POST">
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="email" required>
    <br>
    <label for="contraseña">Contraseña:</label>
    <input type="password" name="contraseña" required>
    <br>
    <button type="submit">Iniciar Sesión</button>
</form>
<p>¿No tienes una cuenta? <a href="index.php?controller=usuario&action=registro">Regístrate aquí</a></p>

<!-- NUEVO ENLACE A LA TIENDA -->
<p><a href="index.php">Volver a la Tienda</a></p>
<?php require __DIR__ . '/../layout/footer.php'; ?>
