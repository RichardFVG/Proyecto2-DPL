<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Eliminar Producto</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (isset($producto)): ?>
<p>¿Seguro que deseas eliminar el producto <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong>?</p>
<form action="index.php?controller=producto&action=procesarEliminar" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
    <button type="submit">Eliminar</button>
    <a href="index.php?controller=producto&action=lista">Cancelar</a>
</form>
<?php else: ?>
    <p>No se encontró el producto.</p>
<?php endif; ?>

<!-- NUEVO ENLACE A LA TIENDA -->
<p><a href="index.php">Volver a la Tienda</a></p>
<?php require __DIR__ . '/../layout/footer.php'; ?>
