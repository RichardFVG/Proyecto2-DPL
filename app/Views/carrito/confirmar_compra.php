<?php
// 1. Incluyo el archivo header.php para la 
// estructura inicial del HTML.
require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Encabezado para indicar el resultado 
 de la compra. -->
<h1>Resultado de la Compra</h1>

<!-- 3. Muestro un mensaje de error o de 
 éxito según corresponda. -->
<?php if (isset($error)): ?>
    <p style="color: red;">
        <?php echo htmlspecialchars($error); ?>
    </p>
<?php else: ?>
    <p>
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>

<!-- 4. Enlace para volver a la página 
 principal de la tienda. -->
<a href="index.php">Volver a la tienda</a>

<?php
// 5. Incluyo el footer para cerrar la 
// estructura HTML adecuadamente.
require __DIR__ . '/../layout/footer.php';
?>
