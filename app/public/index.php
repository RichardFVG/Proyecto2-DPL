<?php
    // 1. Incluyo el archivo de configuración 
    // con la conexión a la base de datos.
    require_once __DIR__ . '/../../app/config/db.php';

    // 2. Asigno controlador y acción a partir 
    // de los parámetros en la URL, o establezco 
    // valores por defecto.
    $controller = $_GET['controller'] ?? 'producto';
    $action = $_GET['action'] ?? 'lista';

    // 3. Utilizo un switch para decidir qué 
    // controlador se va a cargar según el 
    // parámetro 'controller'.
    switch ($controller) {
        // 4. Caso de manejo de usuarios 
        // (login, registro, etc.).
        case 'usuario':
            require_once __DIR__ . 
            '/../../app/Controllers/UsuarioController.php';
            $ctrl = new UsuarioController($conn);

            // 5. Dependiendo de la acción, llamo 
            // al método correspondiente del 
            // controlador de usuario.
            switch ($action) {
                case 'login':
                    $ctrl->login();
                    break;
                case 'procesarLogin':
                    $ctrl->procesarLogin();
                    break;
                case 'registro':
                    $ctrl->registro();
                    break;
                case 'procesarRegistro':
                    $ctrl->procesarRegistro();
                    break;
                case 'logout':
                    $ctrl->logout();
                    break;
                default:
                    // 6. Acción por defecto si no 
                    // se encuentra la acción indicada.
                    $ctrl->login();
            }
            break;

        // 7. Caso de manejo de productos (lista, 
        // agregar, editar, eliminar).
        case 'producto':
            require_once __DIR__ . 
            '/../../app/Controllers/ProductoController.php';
            $ctrl = new ProductoController($conn);

            // 8. Decido la acción en base al 
            // parámetro 'action'.
            switch ($action) {
                case 'lista':
                    $ctrl->lista();
                    break;
                case 'agregar':
                    $ctrl->agregar();
                    break;
                case 'procesarAgregar':
                    $ctrl->procesarAgregar();
                    break;
                case 'editar':
                    $ctrl->editar();
                    break;
                case 'procesarEditar':
                    $ctrl->procesarEditar();
                    break;
                case 'eliminar':
                    $ctrl->eliminar();
                    break;
                case 'procesarEliminar':
                    $ctrl->procesarEliminar();
                    break;
                default:
                    $ctrl->lista();
            }
            break;

        // 9. Caso de manejo del carrito (ver, 
        // agregar, eliminar, checkout, etc.).
        case 'carrito':
            require_once __DIR__ . 
            '/../../app/Controllers/CarritoController.php';
            $ctrl = new CarritoController($conn);

            switch ($action) {
                case 'ver':
                    $ctrl->ver();
                    break;
                case 'agregar':
                    $ctrl->agregar();
                    break;
                case 'eliminarDelCarrito':
                    $ctrl->eliminarDelCarrito();
                    break;
                case 'checkout':
                    $ctrl->checkout();
                    break;
                case 'confirmarCompra':
                    $ctrl->confirmarCompra();
                    break;
                case 'actualizarCantidad':
                    $ctrl->actualizarCantidad();
                    break;
                default:
                    $ctrl->ver();
            }
            break;

        // 10. Controlador y acción por defecto 
        // si el parámetro no coincide con los 
        // casos anteriores.
        default:
            require_once __DIR__ . 
            '/../../app/Controllers/ProductoController.php';
            $ctrl = new ProductoController($conn);
            $ctrl->lista();
            break;
    }
?>
