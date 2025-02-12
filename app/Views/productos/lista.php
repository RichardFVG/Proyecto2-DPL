<?php
// 1. Incluyo el archivo header.php para la 
// estructura inicial de la página y la barra 
// de navegación.
require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Título principal para indicar que se 
 trata de la lista de productos. -->
<h1>Lista de Productos</h1>

<!-- 3. Enlace para acceder a la sección de 
 agregar un nuevo producto. -->
<a href="index.php?controller=producto&action=agregar">
    Agregar Producto
</a>

<!-- 4. Muestro la lista de productos en un 
 elemento <ul>. -->
<ul>
    <!-- 5. Recorro el array de productos, 
     creando un <li> por cada uno. -->
    <?php foreach ($productos as $producto): ?>
        <li>
            <!-- 6. Título del producto con 
             un encabezado <h2>. -->
            <h2>
                <?php echo htmlspecialchars($producto['nombre']); ?>
            </h2>

            <!-- 7. Descripción del producto, 
             escapando caracteres para evitar 
             XSS. -->
            <p>
                <?php echo htmlspecialchars($producto['descripcion']); ?>
            </p>

            <!-- 8. Precio del producto, usando 
             number_format para dos decimales. -->
            <p>
                Precio: €<?php echo number_format($producto['precio'], 2); ?>
            </p>
            
            <!-- 9. Enlace para editar el producto, 
             pasando el ID en la URL. -->
            <a href="index.php?controller=producto&action=editar&id=<?php echo $producto['id']; ?>">
                Editar
            </a>

            <!-- 10. Enlace para eliminar el producto, 
             con confirmación en el evento onclick. -->
            <a href="index.php?controller=producto&action=eliminar&id=<?php echo $producto['id']; ?>" 
               onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                Eliminar
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<br>

<!-- 11. Enlace para regresar a la tienda 
 principal. -->
<a href="index.php">Volver a la Tienda</a>

<?php
// 12. Incluyo el footer para cerrar la 
// estructura HTML.
require __DIR__ . '/../layout/footer.php';
?>
