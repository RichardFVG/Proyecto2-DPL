<?php
    // 1. Incluyo el encabezado general (header.php), 
    // que contiene la estructura inicial de la página.
    require __DIR__ . '/../layout/header.php';
?>

<!-- 2. Muestro el título de la sección de 
confirmación de compra. -->
<h1>Confirmación de Compra</h1>

<!-- 3. Formulario para que el usuario 
introduzca su email y confirme la compra. -->
<form action="index.php?controller=carrito&action=confirmarCompra" 
method="POST">
    <!-- 4. Etiqueta e input para solicitar 
    el correo electrónico del usuario. -->
    <label for="email">
        Correo Electrónico para el Recibo:
    </label>
    <input type="email" name="email" required>
    <br>

    <!-- 5. Botón de acción para confirmar y 
    comprar. -->
    <button type="submit">Confirmar y Comprar</button>
</form>

<!-- 6. Enlace de retorno al carrito si el 
usuario desea revisar o cambiar algo antes 
de confirmar. -->
<a href="index.php?controller=carrito&action=ver">
    Volver al Carrito
</a>

<!-- 7. Agrego un párrafo con el enlace para 
volver a la página principal (tienda). -->
<p>
    <a href="index.php">Volver a la Tienda</a>
</p>

<?php
    // 8. Incluyo el pie de página (footer.php), 
    // que cierra la estructura HTML.
    require __DIR__ . '/../layout/footer.php';
?>
