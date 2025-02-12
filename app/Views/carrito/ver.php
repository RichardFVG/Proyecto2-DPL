<?php 
// 1. Incluyo la cabecera (header.php) que 
// contiene el inicio del HTML y la barra de 
// navegación.
require __DIR__ . '/../layout/header.php'; 
?>

<!-- 2. Título principal para indicar que se 
 trata de la vista del carrito de compras. -->
<h1>Mi Carrito de Compras</h1>

<!-- 3. Verifico si el carrito no está vacío 
 para mostrar los productos o un mensaje de 
 que está vacío. -->
<?php if (count($carrito) > 0): ?>
    <ul style="list-style: none;">
        <!-- 4. Recorro cada producto en el 
         carrito y muestro sus datos. -->
        <?php foreach ($carrito as $item): ?>
            <li>
                <h2>
                    <?php echo htmlspecialchars($item['nombre']); ?>
                </h2>

                <!-- 5. Muestro la imagen del 
                 producto con un ancho máximo 
                 de 100px. -->
                <img src="<?php echo htmlspecialchars($item['imagen']); ?>"
                     alt="<?php echo htmlspecialchars($item['nombre']); ?>" 
                     style="max-width:100px;">

                <!-- 6. Muestro el precio, 
                 formateándolo con 2 decimales. -->
                <p>
                    Precio: €<?php echo number_format($item['precio'], 2); ?>
                </p>

                <!-- 7. Muestro la cantidad actual 
                 del producto en el carrito. -->
                <p>
                    Cantidad: <?php echo htmlspecialchars($item['cantidad']); ?>
                </p>

                <!-- 8. Solo si el usuario no es admin, 
                 permito eliminar parcial o totalmente 
                 el producto. -->
                <?php if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0): ?>
                    <!-- 9. Formulario para eliminar 
                     cierta cantidad de unidades de un 
                     producto. -->
                    <form action="index.php?controller=carrito&action=actualizarCantidad" 
                          method="POST" 
                          style="display:inline-block;">
                        <input type="hidden" name="id_carrito" 
                               value="<?php echo $item['id_carrito']; ?>">

                        <!-- 10. Campo para indicar la 
                         cantidad a eliminar, por 
                         defecto 1. -->
                        <input type="number" name="cantidad" 
                               min="1" max="<?php echo $item['cantidad']; ?>" 
                               value="1" required>

                        <button type="submit">Eliminar unidades</button>
                    </form>

                    <!-- 11. Enlace para eliminar todas 
                     las unidades de este producto. -->
                    <a href="index.php?controller=carrito&action=eliminarDelCarrito&id_carrito=<?php echo $item['id_carrito']; ?>">
                        Eliminar todo
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- 12. Si no es admin, muestro el botón para ir 
     a la página de checkout. -->
    <?php if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0): ?>
        <a href="index.php?controller=carrito&action=checkout">
            Proceder al Pago
        </a><br>
    <?php endif; ?>

<!-- 13. Si el carrito está vacío, muestro un mensaje 
 informando al usuario. -->
<?php else: ?>
    <p>No hay productos en tu carrito.</p>
<?php endif; ?>

<br>
<!-- 14. Enlace para volver a la tienda 
 principal. -->
<a href="index.php">Volver a la Tienda</a>

<?php 
// 15. Incluyo el footer que cierra el HTML.
require __DIR__ . '/../layout/footer.php'; 
?>
