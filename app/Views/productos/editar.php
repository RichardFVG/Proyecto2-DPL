<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Editar Producto</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (isset($producto)): ?>
<form action="index.php?controller=producto&action=procesarEditar" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required><br><br>

    <label>Descripción:</label>
    <textarea name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea><br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required><br><br>

    <?php if (!empty($producto['imagen'])): ?>
        <p>Imagen actual:</p>
        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" style="max-width: 200px;">
        <br><br>
    <?php endif; ?>

    <label>Cambiar Imagen (opcional):</label>
    <input type="file" name="imagen" accept="image/*"><br><br>

    <label>
        <input type="checkbox" name="eliminar_imagen" value="1"> Eliminar imagen actual (volverá a la imagen por defecto si no se sube una nueva)
    </label>
    <br><br>

    <input type="submit" value="Actualizar Producto">
</form>
<?php else: ?>
    <p>No se encontró el producto.</p>
<?php endif; ?>

<p><a href="index.php?controller=producto&action=lista">← Volver a la lista de productos</a></p>
<p><a href="index.php">Volver a la Tienda</a></p>
<?php require __DIR__ . '/../layout/footer.php'; ?>
