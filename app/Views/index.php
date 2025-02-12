<!-- 1. Vista principal que muestra los productos 
 disponibles. -->
<?php 
// 2. Incluyo el header que contiene la cabecera 
// HTML, menú de navegación, etc.
require __DIR__ . '/layout/header.php'; 
?> 

<?php 
// 3. Evito errores si la variable $productos no 
// está definida.
if (!isset($productos)) {
    $productos = [];
}
?>

<!-- 4. Título de la sección de productos 
 disponibles. -->
<h2>Productos Disponibles</h2>

<!-- 5. Contenedor con clase 'productos' para 
 aplicar estilos en display flex. -->
<div class="productos">
    <!-- 6. Recorro el array de $productos, mostrando 
     cada uno dentro de un div con la clase 
     'producto'. -->
    <?php foreach ($productos as $producto): ?>
        <div class="producto">
            <!-- 7. Muestro el nombre del producto en un 
             <h3>, escapando caracteres especiales. -->
            <h3>
                <?php echo htmlspecialchars($producto['nombre']); ?>
            </h3>

            <!-- 8. Muestro la imagen asociada al producto, 
             con alt dinámico para accesibilidad. -->
            <img 
                src="<?php echo htmlspecialchars($producto['imagen']); ?>"
                alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
            >

            <!-- 9. Descripción del producto, también 
             escapada para prevenir XSS. -->
            <p>
                <?php echo htmlspecialchars($producto['descripcion']); ?>
            </p>

            <!-- 10. Precio formateado con 2 decimales, 
             precedido de '€'. -->
            <p>
                Precio: €<?php echo number_format($producto['precio'], 2); ?>
            </p>

            <!-- 11. Controlo las opciones según sea 
             admin o usuario normal. -->
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <!-- 12. Enlaces para que el administrador 
                 pueda editar o eliminar el producto. -->
                <a 
                    href="index.php?controller=producto&action=editar&id=<?php echo $producto['id']; ?>">
                    Editar
                </a>

                <a 
                    href="index.php?controller=producto&action=eliminar&id=<?php echo $producto['id']; ?>" 
                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                    Eliminar
                </a>
            <?php else: ?>
                <!-- 13. Para un usuario normal, muestro la 
                 opción de agregar al carrito si está 
                 logueado. -->
                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <a 
                        href="index.php?controller=carrito&action=agregar&id=<?php echo $producto['id']; ?>">
                        Agregar al Carrito
                    </a>
                <?php else: ?>
                    <!-- 14. Si el usuario no ha iniciado 
                     sesión, ofrezco el enlace al login. -->
                    <p>
                        <a href="index.php?controller=usuario&action=login">
                            Inicia sesión para comprar
                        </a>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php 
// 15. Incluyo el footer para cerrar la estructura HTML.
require __DIR__ . '/layout/footer.php'; 
?>
