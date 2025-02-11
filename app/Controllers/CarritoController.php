<?php
require_once __DIR__ . '/../Models/CarritoModel.php';
require_once __DIR__ . '/../Models/ProductoModel.php';
require_once __DIR__ . '/../helpers/seguridad.php';

class CarritoController {
    private $carritoModel;
    private $productoModel;

    public function __construct($conn) {
        $this->carritoModel = new CarritoModel($conn);
        $this->productoModel = new ProductoModel($conn);
    }

    private function checkLogin() {
        session_start();
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: index.php?controller=usuario&action=login");
            exit;
        }
    }

    public function ver() {
        $this->checkLogin();
        $id_usuario = $_SESSION['id_usuario'];
        $carrito = $this->carritoModel->obtenerCarrito($id_usuario);
        require __DIR__ . '/../Views/carrito/ver.php';
    }

    public function agregar() {
        $this->checkLogin();
        $id_usuario = $_SESSION['id_usuario'];
        $id_producto = filtrarEntero($_GET['id'] ?? 0);
        $this->carritoModel->agregarAlCarrito($id_usuario, $id_producto);
        header("Location: index.php?controller=carrito&action=ver&message=Producto+añadido+al+carrito");
    }

    public function eliminarDelCarrito() {
        $this->checkLogin();
        $id_carrito = filtrarEntero($_GET['id_carrito'] ?? 0);
        $this->carritoModel->eliminarDelCarrito($id_carrito);
        header("Location: index.php?controller=carrito&action=ver&message=Producto+eliminado");
    }

    public function checkout() {
        $this->checkLogin();
        require __DIR__ . '/../Views/carrito/checkout.php';
    }

    public function confirmarCompra() {
        $this->checkLogin();
        $email = filtrarEmail($_POST['email'] ?? '');
        $id_usuario = $_SESSION['id_usuario'];

        // Obtener detalles del carrito
        $carrito = $this->carritoModel->obtenerCarrito($id_usuario);
        $contenido = "<h1>Recibo de Compra</h1>";
        $total = 0;

        // La URL de las imágenes (depende de la ubicación local de 
        // la carpeta del proyecto, hay mejores maneras de hacerlo 
        // pero por ahora lo dejé así)
        $base_url = "http://localhost/UT4_PY_VacaGarciaRichardFrancisco/public/";

        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            // Incluir imagen del producto en el recibo:
            $contenido .= "<p><img src='" . $base_url . htmlspecialchars($item['imagen']) . "' style='max-width:100px; vertical-align:middle; margin-right:10px;'>"
                        . htmlspecialchars($item['nombre']) . " x " . htmlspecialchars($item['cantidad']) 
                        . " = €" . number_format($subtotal, 2) . "</p>";
            $total += $subtotal;
        }
        $contenido .= "<p><strong>Total: €" . number_format($total, 2) . "</strong></p>";

        // Envío de correo con Mailjet
        $apiKeyPublic = 'b202e7778b9637602c4d8fb04b91c499';
        $apiKeyPrivate = '80c87ad5670a6b953db04a462f117eef';

        $data = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'richi3fvg@gmail.com',
                        'Name' => 'Plataforma Médica'
                    ],
                    'To' => [
                        [
                            'Email' => $email,
                            'Name' => $_SESSION['nombre_usuario']
                        ]
                    ],
                    'Subject' => 'Recibo de tu Compra',
                    'HTMLPart' => $contenido,
                ]
            ]
        ];

        $ch = curl_init('https://api.mailjet.com/v3.1/send');
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$apiKeyPublic:$apiKeyPrivate");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            $error = "Lo siento, ha habido un error al enviar el recibo: $err";
        } else {
            $message = "Compra confirmada. El recibo ha sido enviado a tu correo.";
        }

        // Vaciar el carrito
        $this->carritoModel->vaciarCarrito($id_usuario);

        // Cargar la vista de confirmación
        require __DIR__ . '/../Views/carrito/confirmar_compra.php';
    }

    // Nueva acción para actualizar la cantidad
    public function actualizarCantidad() {
        $this->checkLogin();
        $id_carrito = filtrarEntero($_POST['id_carrito'] ?? 0);
        $cantidadAEliminar = filtrarEntero($_POST['cantidad'] ?? 0);

        $linea = $this->carritoModel->obtenerLineaCarrito($id_carrito);
        if ($linea && $linea['id_usuario'] == $_SESSION['id_usuario']) {
            $nuevaCantidad = $linea['cantidad'] - $cantidadAEliminar;
            if ($nuevaCantidad > 0) {
                $this->carritoModel->actualizarCantidad($id_carrito, $nuevaCantidad);
            } else {
                // Si la nueva cantidad es 0 o menos, eliminamos la línea
                $this->carritoModel->eliminarDelCarrito($id_carrito);
            }
        }

        header("Location: index.php?controller=carrito&action=ver&message=Cantidad+actualizada");
    }
}
