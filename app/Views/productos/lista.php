<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Lista de Productos</h1>
<a href="index.php?controller=producto&action=agregar">Agregar Producto</a>
<ul>
    <?php foreach ($productos as $producto): ?>
        <li>
            <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <p>Precio: €<?php echo number_format($producto['precio'], 2); ?></p>
            <a href="index.php?controller=producto&action=editar&id=<?php echo $producto['id']; ?>">Editar</a>
            <a href="index.php?controller=producto&action=eliminar&id=<?php echo $producto['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
        </li>
    <?php endforeach; ?>
</ul>
<br>
<a href="index.php">Volver a la Tienda</a>
<?php require __DIR__ . '/../layout/footer.php'; ?>
