<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Confirmación de Compra</h1>
<form action="index.php?controller=carrito&action=confirmarCompra" method="POST">
    <label for="email">Correo Electrónico para el Recibo:</label>
    <input type="email" name="email" required>
    <br>
    <button type="submit">Confirmar y Comprar</button>
</form>
<a href="index.php?controller=carrito&action=ver">Volver al Carrito</a>
<!-- NUEVO ENLACE A LA TIENDA -->
<p><a href="index.php">Volver a la Tienda</a></p>
<?php require __DIR__ . '/../layout/footer.php'; ?>
