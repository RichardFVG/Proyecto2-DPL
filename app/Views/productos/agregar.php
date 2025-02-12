<?php
// 1. Incluyo el archivo header.php que 
// contiene la estructura inicial de la 
// página.
require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Título para indicar que estamos 
 agregando un nuevo producto. -->
<h1>Agregar Nuevo Producto</h1>

<!-- 3. Si existe un mensaje de error en 
 la variable $error, lo muestro en color 
 rojo. -->
<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php echo htmlspecialchars($error); ?>
    </p>
<?php endif; ?>

<!-- 4. Formulario para añadir un nuevo 
 producto, con enctype="multipart/form-data" 
 para subir una imagen. -->
<form action="index.php?controller=producto&action=procesarAgregar" 
      method="POST" 
      enctype="multipart/form-data">
    
    <!-- 5. Campo para el nombre del producto, 
     requerido. -->
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <br><br>

    <!-- 6. Campo para la descripción del 
     producto, también requerido. -->
    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>
    <br><br>

    <!-- 7. Campo para el precio del producto, 
     aceptando decimales con step="0.01". -->
    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required>
    <br><br>

    <!-- 8. Campo para subir una imagen del 
     producto, opcional, aceptando distintos 
     formatos de imagen. -->
    <label>Imagen del Producto (opcional):</label>
    <input type="file" name="imagen" accept="image/*">
    <br><br>

    <!-- 9. Botón para enviar el formulario y 
     crear el nuevo producto. -->
    <input type="submit" value="Agregar Producto">
</form>

<!-- 10. Enlace para volver a la lista de 
 productos, en caso de que el usuario quiera 
 cancelar. -->
<p>
    <a href="index.php?controller=producto&action=lista">
        ← Volver a la lista de productos
    </a>
</p>

<!-- 11. Enlace para regresar a la página 
 principal de la tienda. -->
<p>
    <a href="index.php">Volver a la Tienda</a>
</p>

<?php
// 12. Incluyo el footer para cerrar la 
// estructura HTML de la página.
require __DIR__ . '/../layout/footer.php';
?>
