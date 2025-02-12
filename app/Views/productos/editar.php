<?php
// 1. Incluyo la cabecera (header.php) para la 
// estructura inicial de la página.
require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Título para indicar que estamos editando 
 un producto. -->
<h1>Editar Producto</h1>

<!-- 3. Si hay un mensaje de error, lo muestro en 
 un párrafo en color rojo. -->
<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php echo htmlspecialchars($error); ?>
    </p>
<?php endif; ?>

<!-- 4. Verifico si existe la variable $producto 
 para mostrar el formulario; si no, muestro un 
 mensaje de no encontrado. -->
<?php if (isset($producto)): ?>

<!-- 5. Formulario que envía los datos al método 
 procesarEditar del controlador de productos. -->
<form action="index.php?controller=producto&action=procesarEditar"
      method="POST" 
      enctype="multipart/form-data">
    
    <!-- 6. Campo oculto para almacenar el ID del 
     producto. -->
    <input type="hidden" name="id" 
           value="<?php echo htmlspecialchars($producto['id']); ?>">

    <!-- 7. Campo para el nombre del producto, con 
     el valor actual precargado y requerido. -->
    <label>Nombre:</label>
    <input type="text" name="nombre" 
           value="<?php echo htmlspecialchars($producto['nombre']); ?>" 
           required><br><br>

    <!-- 8. Campo para la descripción, con el valor 
     actual dentro de un textarea. -->
    <label>Descripción:</label>
    <textarea name="descripcion" required>
        <?php echo htmlspecialchars($producto['descripcion']); ?>
    </textarea><br><br>

    <!-- 9. Campo para el precio, con step de 0.01, 
     mostrando el precio actual. -->
    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" 
           value="<?php echo htmlspecialchars($producto['precio']); ?>" 
           required><br><br>

    <!-- 10. Muestro la imagen actual del producto 
     si existe. -->
    <?php if (!empty($producto['imagen'])): ?>
        <p>Imagen actual:</p>
        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" 
             alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
             style="max-width: 200px;">
        <br><br>
    <?php endif; ?>

    <!-- 11. Campo opcional para subir una nueva 
     imagen del producto. -->
    <label>Cambiar Imagen (opcional):</label>
    <input type="file" name="imagen" accept="image/*"><br><br>

    <!-- 12. Checkbox para eliminar la imagen actual, 
     volviendo a la imagen por defecto si no se sube 
     una nueva. -->
    <label>
        <input type="checkbox" name="eliminar_imagen" value="1"> 
        Eliminar imagen actual 
        (volverá a la imagen por defecto si no se sube una nueva)
    </label>
    <br><br>

    <!-- 13. Botón para actualizar el producto. -->
    <input type="submit" value="Actualizar Producto">
</form>

<?php else: ?>
    <!-- 14. En caso de no encontrar el producto, 
     muestro un mensaje al usuario. -->
    <p>No se encontró el producto.</p>
<?php endif; ?>

<!-- 15. Enlace para volver a la lista de 
 productos. -->
<p>
    <a href="index.php?controller=producto&action=lista">
        ← Volver a la lista de productos
    </a>
</p>

<!-- 16. Enlace para regresar a la tienda 
 principal. -->
<p>
    <a href="index.php">Volver a la Tienda</a>
</p>

<?php
// 17. Incluyo el footer (footer.php) para 
// cerrar la estructura HTML.
require __DIR__ . '/../layout/footer.php';
?>
