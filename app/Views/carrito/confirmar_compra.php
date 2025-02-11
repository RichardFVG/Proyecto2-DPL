<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Resultado de la Compra</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php else: ?>
    <p><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<a href="index.php">Volver a la tienda</a>
<?php require __DIR__ . '/../layout/footer.php'; ?>
