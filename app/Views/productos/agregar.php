<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Agregar Nuevo Producto</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<form action="index.php?controller=producto&action=procesarAgregar" method="POST" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea><br><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required><br><br>

    <label>Imagen del Producto (opcional):</label>
    <input type="file" name="imagen" accept="image/*"><br><br>

    <input type="submit" value="Agregar Producto">
</form>
<p><a href="index.php?controller=producto&action=lista">← Volver a la lista de productos</a></p>
<p><a href="index.php">Volver a la Tienda</a></p>
<?php require __DIR__ . '/../layout/footer.php'; ?>
