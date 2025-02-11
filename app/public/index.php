<?php
require_once __DIR__ . '/../../app/config/db.php';

// Router básico
$controller = $_GET['controller'] ?? 'producto';
$action = $_GET['action'] ?? 'lista';

switch ($controller) {
    case 'usuario':
        require_once __DIR__ . '/../../app/Controllers/UsuarioController.php';
        $ctrl = new UsuarioController($conn);
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
                $ctrl->login();
        }
        break;

    case 'producto':
        require_once __DIR__ . '/../../app/Controllers/ProductoController.php';
        $ctrl = new ProductoController($conn);
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

    case 'carrito':
        require_once __DIR__ . '/../../app/Controllers/CarritoController.php';
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
            case 'actualizarCantidad': // Agregamos este caso
                $ctrl->actualizarCantidad();
                break;
            default:
                $ctrl->ver();
        }
        break;  

    default:
        require_once __DIR__ . '/../../app/Controllers/ProductoController.php';
        $ctrl = new ProductoController($conn);
        $ctrl->lista();
        break;
}
