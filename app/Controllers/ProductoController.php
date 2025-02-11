<?php 
require_once __DIR__ . '/../Models/ProductoModel.php';
require_once __DIR__ . '/../helpers/seguridad.php';

class ProductoController {
    private $productoModel;

    public function __construct($conn) {
        $this->productoModel = new ProductoModel($conn);
    }

    public function lista() {
        $productos = $this->productoModel->obtenerTodos();
        require __DIR__ . '/../Views/index.php';
    }

    public function agregar() {
        require __DIR__ . '/../Views/productos/agregar.php';
    }

    public function procesarAgregar() {
        $nombre = filtrarTexto($_POST['nombre'] ?? '');
        $descripcion = filtrarTexto($_POST['descripcion'] ?? '');
        $precio = filtrarDecimal($_POST['precio'] ?? 0);
        $imagen = 'img/n1.png'; // Imagen por defecto

        // Manejo de imagen subida
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nombreImagen = basename($_FILES['imagen']['name']);
            $rutaImagen = 'img/' . $nombreImagen;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
                $imagen = $rutaImagen;
            }
        }

        if ($this->productoModel->agregar($nombre, $descripcion, $precio, $imagen)) {
            header("Location: index.php?controller=producto&action=lista&message=Producto+añadido");
        } else {
            $error = "Error al agregar producto.";
            require __DIR__ . '/../Views/productos/agregar.php';
        }
    }

    public function editar() {
        $id = filtrarEntero($_GET['id'] ?? 0);
        $producto = $this->productoModel->obtenerPorId($id);
        if (!$producto) {
            $error = "Producto no encontrado.";
        }
        require __DIR__ . '/../Views/productos/editar.php';
    }

    public function procesarEditar() {
        $id = filtrarEntero($_POST['id'] ?? 0);
        $nombre = filtrarTexto($_POST['nombre'] ?? '');
        $descripcion = filtrarTexto($_POST['descripcion'] ?? '');
        $precio = filtrarDecimal($_POST['precio'] ?? 0);

        // Obtenemos el producto actual para saber su imagen previa
        $productoActual = $this->productoModel->obtenerPorId($id);
        $imagen = $productoActual ? $productoActual['imagen'] : 'img/n1.png';

        // Si el admin marcó "eliminar imagen"
        if (isset($_POST['eliminar_imagen']) && $_POST['eliminar_imagen'] == 1) {
            $imagen = 'img/n1.png';
        }

        // Si se sube una nueva imagen, la reemplazamos
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nombreImagen = basename($_FILES['imagen']['name']);
            $rutaImagen = 'img/' . $nombreImagen;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
                $imagen = $rutaImagen;
            }
        }

        if ($this->productoModel->editar($id, $nombre, $descripcion, $precio, $imagen)) {
            header("Location: index.php?controller=producto&action=lista&message=Producto+actualizado");
        } else {
            $error = "Error al actualizar el producto.";
            require __DIR__ . '/../Views/productos/editar.php';
        }
    }

    public function eliminar() {
        $id = filtrarEntero($_GET['id'] ?? 0);
        $producto = $this->productoModel->obtenerPorId($id);
        if (!$producto) {
            $error = "Producto no encontrado.";
        }
        require __DIR__ . '/../Views/productos/eliminar.php';
    }

    public function procesarEliminar() {
        $id = filtrarEntero($_POST['id'] ?? 0);

        if ($this->productoModel->eliminar($id)) {
            header("Location: index.php?controller=producto&action=lista&message=Producto+eliminado");
        } else {
            $error = "Error al eliminar el producto.";
            require __DIR__ . '/../Views/productos/eliminar.php';
        }
    }
}
