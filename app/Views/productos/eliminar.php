<?php
    // 1. Incluyo el archivo de cabecera (header.php) 
    // para la estructura inicial de la página.
    require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Título para indicar que se trata de la 
vista de eliminación de productos. -->
<h1>Eliminar Producto</h1>

<!-- 3. Muestro un mensaje de error si existe 
alguna variable $error definida. -->
<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php 
            echo htmlspecialchars($error); 
        ?>
    </p>
<?php endif; ?>

<!-- 4. Verifico si la variable $producto está 
configurada para mostrar los datos del producto. -->
<?php if (isset($producto)): ?>
    <p>
        ¿Seguro que deseas eliminar el producto 
        <strong><?php 
            echo htmlspecialchars(
                $producto['nombre']
            ); 
        ?></strong>?
    </p>

    <!-- 5. Formulario para confirmar la eliminación 
    del producto. -->
    <form action="index.php?controller=producto&action=procesarEliminar" 
    method="POST">
        <!-- 6. Campo oculto para mantener el ID del 
        producto a eliminar. -->
        <input type="hidden" name="id" 
        value="<?php 
            echo htmlspecialchars($producto['id']); 
        ?>">

        <!-- 7. Botón para eliminar el producto. -->
        <button type="submit">Eliminar</button>
        <!-- 8. Enlace para cancelar y volver a la 
        lista de productos sin eliminar nada. -->
        <a href="index.php?controller=producto&action=lista">
            Cancelar
        </a>
    </form>
<?php else: ?>
    <!-- 9. Mensaje si no se encontró el producto o 
    no está definido en la variable. -->
    <p>No se encontró el producto.</p>
<?php endif; ?>

<!-- 10. Enlace para regresar a la tienda 
principal. -->
<p>
    <a href="index.php">Volver a la Tienda</a>
</p>

<?php
    // 11. Incluyo el footer (footer.php) que cierra la 
    // estructura HTML.
    require __DIR__ . '/../layout/footer.php';
?>
