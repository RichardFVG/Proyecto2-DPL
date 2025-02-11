<!-- Views/carrito/ver.php -->
<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Mi Carrito de Compras</h1>
<?php if (count($carrito) > 0): ?>
    <ul style="list-style: none;">
    <?php foreach ($carrito as $item): ?>
        <li>
            <h2><?php echo htmlspecialchars($item['nombre']); ?></h2>
            <img src="<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>" style="max-width:100px;">
            <p>Precio: €<?php echo number_format($item['precio'], 2); ?></p>
            <p>Cantidad: <?php echo htmlspecialchars($item['cantidad']); ?></p>

            <?php if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0): ?>
                <!-- Formulario para eliminar cierta cantidad de productos -->
                <form action="index.php?controller=carrito&action=actualizarCantidad" method="POST" style="display:inline-block;">
                    <input type="hidden" name="id_carrito" value="<?php echo $item['id_carrito']; ?>">
                    <input type="number" name="cantidad" min="1" max="<?php echo $item['cantidad']; ?>" value="1" required>
                    <button type="submit">Eliminar unidades</button>
                </form>
                <!-- Link para eliminar todo el producto -->
                <a href="index.php?controller=carrito&action=eliminarDelCarrito&id_carrito=<?php echo $item['id_carrito']; ?>">Eliminar todo</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0): ?>
        <a href="index.php?controller=carrito&action=checkout">Proceder al Pago</a><br>
    <?php endif; ?>
<?php else: ?>
    <p>No hay productos en tu carrito.</p>
<?php endif; ?>
<br>
<a href="index.php">Volver a la Tienda</a>
<?php require __DIR__ . '/../layout/footer.php'; ?>
