<?php
// 1. Aquí incluyo el archivo del modelo de Carrito, 
// el modelo de Producto y mis funciones de seguridad.
require_once __DIR__ . '/../Models/CarritoModel.php';
require_once __DIR__ . '/../Models/ProductoModel.php';
require_once __DIR__ . '/../helpers/seguridad.php';

// 2. Declaro la clase CarritoController para manejar 
// las acciones relacionadas con el carrito de compras.
class CarritoController {
    // 3. Defino propiedades para los modelos de 
    // carrito y producto.
    private $carritoModel;
    private $productoModel;

    // 4. En el constructor, recibo la conexión a la 
    // base de datos y creo instancias de los modelos.
    public function __construct($conn) {
        $this->carritoModel = new CarritoModel($conn);
        $this->productoModel = new ProductoModel($conn);
    }

    // 5. Esta función privada me asegura que el 
    // usuario esté logueado; si no, lo redirijo 
    // al login.
    private function checkLogin() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }
    }

    // 6. Muestro el contenido del carrito del 
    // usuario actual.
    public function ver() {
        $this->checkLogin();
        $id_usuario = $_SESSION['id_usuario'];

        // 7. Obtengo el listado de productos en el 
        // carrito.
        $carrito = $this->carritoModel->obtenerCarrito($id_usuario);

        // 8. Cargo la vista correspondiente para 
        // mostrar el carrito.
        require __DIR__ . '/../Views/carrito/ver.php';
    }

    // 9. Agrego un producto al carrito, verificando 
    // que el usuario esté logueado.
    public function agregar() {
        $this->checkLogin();
        $id_usuario = $_SESSION['id_usuario'];

        // 10. Obtengo el ID del producto a partir de 
        // la URL y lo filtro para mayor seguridad.
        $id_producto = filtrarEntero($_GET['id'] ?? 0);

        // 11. Llamo al modelo para añadir el producto 
        // al carrito.
        $this->carritoModel->agregarAlCarrito($id_usuario, $id_producto);

        // 12. Redirijo nuevamente a la vista del 
        // carrito con un mensaje de confirmación.
        header("Location: index.php?controller=carrito&action=ver&message=Producto+añadido+al+carrito");
    }

    // 13. Permito eliminar completamente un producto 
    // del carrito.
    public function eliminarDelCarrito() {
        $this->checkLogin();
        $id_carrito = filtrarEntero($_GET['id_carrito'] ?? 0);

        // 14. Llamo al modelo para eliminar la 
        // línea correspondiente en el carrito.
        $this->carritoModel->eliminarDelCarrito($id_carrito);

        // 15. Redirijo al usuario de vuelta a la 
        // vista del carrito con un mensaje.
        header("Location: index.php?controller=carrito&action=ver&message=Producto+eliminado");
    }

    // 16. Muestro la página de checkout para que 
    // el usuario confirme sus datos y la compra.
    public function checkout() {
        $this->checkLogin();
        require __DIR__ . '/../Views/carrito/checkout.php';
    }

    // 17. Confirmo la compra, envío el recibo por 
    // correo y vacío el carrito.
    public function confirmarCompra() {
        $this->checkLogin();

        // 18. Filtro el email recibido a través de 
        // POST.
        $email = filtrarEmail($_POST['email'] ?? '');
        $id_usuario = $_SESSION['id_usuario'];

        // 19. Obtengo el contenido del carrito para 
        // generar el recibo.
        $carrito = $this->carritoModel->obtenerCarrito($id_usuario);

        $contenido = "<h1>Recibo de Compra</h1>";
        $total = 0;

        // 20. Defino la URL base para mostrar las 
        // imágenes en el correo.
        $base_url = "http://localhost/UT4_PY_VacaGarciaRichardFrancisco/public/";

        // 21. Recorro cada producto en el carrito 
        // para calcular subtotal y armar el contenido 
        // HTML del recibo.
        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $contenido .= "<p><img src='" . $base_url . htmlspecialchars($item['imagen']) . "' style='max-width:100px; vertical-align:middle; margin-right:10px;'>"
                        . htmlspecialchars($item['nombre']) . " x "
                        . htmlspecialchars($item['cantidad']) . " = €" . number_format($subtotal, 2) . "</p>";
            $total += $subtotal;
        }

        // 22. Agrego el total final al contenido.
        $contenido .= "<p><strong>Total: €" . number_format($total, 2) . "</strong></p>";

        // 23. Configuración para enviar el correo con 
        // la API de Mailjet.
        $apiKeyPublic = 'b202e7778b9637602c4d8fb04b91c499';
        $apiKeyPrivate = '80c87ad5670a6b953db04a462f117eef';

        $data = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'richi3fvg@gmail.com',
                        'Name'  => 'Plataforma Médica'
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name'  => $_SESSION['nombre_usuario']
                        ]
                    ],
                    'Subject' => 'Recibo de tu Compra',
                    'HTMLPart' => $contenido,
                ]
            ]
        ];

        // 24. Uso cURL para mandar la solicitud a 
        // Mailjet.
        $ch = curl_init('https://api.mailjet.com/v3.1/send');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$apiKeyPublic:$apiKeyPrivate");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        // 25. Verifico si hubo un error al enviar el 
        // correo o si se envió correctamente.
        if ($err) {
            $error = "Lo siento, ha habido un error al enviar el recibo: $err";
        } else {
            $message = "Compra confirmada. El recibo ha sido enviado a tu correo.";
        }

        // 26. Vacío el carrito porque la compra ya se 
        // confirmó.
        $this->carritoModel->vaciarCarrito($id_usuario);

        // 27. Cargo la vista de confirmación de compra.
        require __DIR__ . '/../Views/carrito/confirmar_compra.php';
    }

    // 28. Acción para disminuir la cantidad de un 
    // producto o eliminarlo si llega a 0.
    public function actualizarCantidad() {
        $this->checkLogin();

        $id_carrito = filtrarEntero($_POST['id_carrito'] ?? 0);
        $cantidadAEliminar = filtrarEntero($_POST['cantidad'] ?? 0);

        // 29. Obtengo la línea del carrito para 
        // asegurarme de que pertenece al usuario.
        $linea = $this->carritoModel->obtenerLineaCarrito($id_carrito);

        // 30. Compruebo que la línea exista y sea 
        // propiedad del usuario.
        if ($linea && $linea['id_usuario'] == $_SESSION['id_usuario']) {
            $nuevaCantidad = $linea['cantidad'] - $cantidadAEliminar;

            // 31. Si sigue habiendo una cantidad 
            // positiva, la actualizo en la BD.
            if ($nuevaCantidad > 0) {
                $this->carritoModel->actualizarCantidad($id_carrito, $nuevaCantidad);
            }
            // 32. Si la cantidad queda en 0 o menos, 
            // elimino directamente la línea del 
            // carrito.
            else {
                $this->carritoModel->eliminarDelCarrito($id_carrito);
            }
        }

        // 33. Redirijo al usuario para que vea el 
        // carrito actualizado con un mensaje.
        header("Location: index.php?controller=carrito&action=ver&message=Cantidad+actualizada");
    }
}
?>
