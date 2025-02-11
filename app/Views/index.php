<!-- Views/index.php -->
<?php require __DIR__ . '/layout/header.php'; ?> 
<h2>Productos Disponibles</h2>
<div class="productos">
    <?php foreach ($productos as $producto): ?>
        <div class="producto">
            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p>Precio: €<?php echo number_format($producto['precio'], 2); ?></p>

            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <!-- Opciones para admin: editar/eliminar el producto -->
                <a href="index.php?controller=producto&action=editar&id=<?php echo $producto['id']; ?>">Editar</a>
                <a href="index.php?controller=producto&action=eliminar&id=<?php echo $producto['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
            <?php else: ?>
                <!-- Opciones para el usuario normal -->
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a href="index.php?controller=carrito&action=agregar&id=<?php echo $producto['id']; ?>">Agregar al Carrito</a>
                <?php else: ?>
                    <p><a href="index.php?controller=usuario&action=login">Inicia sesión para comprar</a></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
