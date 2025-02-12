<?php
    // 1. Incluyo el modelo de productos y mis funciones 
    // de seguridad para usarlas en este controlador.
    require_once __DIR__ . '/../Models/ProductoModel.php';
    require_once __DIR__ . '/../helpers/seguridad.php';

    // 2. Defino la clase ProductoController para manejar 
    // las operaciones sobre los productos.
    class ProductoController {
        // 3. Declaro la propiedad para almacenar la 
        // instancia de mi modelo de productos.
        private $productoModel;

        // 4. En el constructor, recibo la conexión y 
        // creo una instancia de ProductoModel.
        public function __construct($conn) {
            $this->productoModel = 
            new ProductoModel($conn);
        }

        // 5. Este método muestra la lista de productos 
        // llamando al modelo y cargando la vista 
        // principal.
        public function lista() {
            $productos = 
            $this->productoModel->obtenerTodos();

            require __DIR__ . '/../Views/index.php';
        }

        // 6. Muestra el formulario para agregar un nuevo 
        // producto.
        public function agregar() {
            require __DIR__ . 
            '/../Views/productos/agregar.php';
        }

        // 7. Procesa los datos del formulario de agregar 
        // producto.
        public function procesarAgregar() {
            $nombre = 
            filtrarTexto($_POST['nombre'] ?? '');

            $descripcion = 
            filtrarTexto($_POST['descripcion'] ?? '');

            $precio = 
            filtrarDecimal($_POST['precio'] ?? 0);

            // 8. Defino una imagen por defecto, en caso 
            // de no subir nada.
            $imagen = 'img/n1.png';

            // 9. Verifico si hay un archivo subido y lo 
            // muevo a la carpeta 'img'.
            if (
                isset($_FILES['imagen']) && 
                $_FILES['imagen']['error'] == 
                UPLOAD_ERR_OK) {
                $nombreImagen = 
                basename($_FILES['imagen']['name']);
                
                $rutaImagen = 'img/' . $nombreImagen;
                if (
                    move_uploaded_file(
                        $_FILES['imagen']['tmp_name'], 
                        $rutaImagen
                    )
                ) {
                    $imagen = $rutaImagen;
                }
            }

            // 10. Llamo al modelo para insertar el nuevo 
            // producto en la base de datos.
            if (
                $this->productoModel->agregar(
                    $nombre, 
                    $descripcion, 
                    $precio, 
                    $imagen
                    )
                ) {
                header(
                    "Location: index.php?controller=producto&action=lista&message=Producto+añadido"
                );
            } 
            
            else {
                $error = "Error al agregar producto.";
                require __DIR__ . 
                '/../Views/productos/agregar.php';
            }
        }

        // 11. Muestra el formulario de edición para un 
        // producto específico.
        public function editar() {
            $id = filtrarEntero($_GET['id'] ?? 0);
            $producto = 
            $this->productoModel->obtenerPorId($id);

            // 12. Si no encuentro el producto, defino un 
            // error para mostrar.
            if (!$producto) {
                $error = "Producto no encontrado.";
            }

            require __DIR__ . '/../Views/productos/editar.php';
        }

        // 13. Procesa la edición de un producto tras 
        // enviar el formulario.
        public function procesarEditar() {
            $id = filtrarEntero($_POST['id'] ?? 0);
            $nombre = filtrarTexto($_POST['nombre'] ?? '');
            $descripcion = 
            filtrarTexto($_POST['descripcion'] ?? '');
            $precio = filtrarDecimal($_POST['precio'] ?? 0);

            // 14. Obtengo el producto actual para conocer 
            // su imagen previa y decidir si la mantengo o no.
            $productoActual = 
            $this->productoModel->obtenerPorId($id);

            // 15. Si no existe, dejo una imagen por defecto; 
            // en caso contrario, uso la que ya tenía.
            $imagen = $productoActual ? 
            $productoActual['imagen'] : 'img/n1.png';

            // 16. Verifico si el usuario ha marcado eliminar 
            // la imagen, con lo que la devuelvo a la imagen 
            // por defecto.
            if (
                isset($_POST['eliminar_imagen']) && 
                $_POST['eliminar_imagen'] == 1
            ) {
                $imagen = 'img/n1.png';
            }

            // 17. Si se sube una nueva imagen, la guardo en 
            // la carpeta 'img' y reemplazo la anterior.
            if (
                isset($_FILES['imagen']) && 
                $_FILES['imagen']['error'] == 
                UPLOAD_ERR_OK
            ) {
                $nombreImagen = 
                basename($_FILES['imagen']['name']);
                $rutaImagen = 'img/' . $nombreImagen;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
                    $imagen = $rutaImagen;
                }
            }

            // 18. Llamo al método editar del modelo para 
            // actualizar la información del producto en 
            // la base de datos.
            if ($this->productoModel->editar(
                $id, 
                $nombre, 
                
                $descripcion, 
                $precio, $imagen)) {
                header("Location: index.php?controller=producto&action=lista&message=Producto+actualizado");
            } else {
                $error = "Error al actualizar el producto.";
                require __DIR__ . '/../Views/productos/editar.php';
            }
        }

        // 19. Muestra la vista para confirmar la 
        // eliminación de un producto.
        public function eliminar() {
            $id = filtrarEntero($_GET['id'] ?? 0);
            $producto = 
            $this->productoModel->obtenerPorId($id);

            // 20. Si no encuentro el producto, defino 
            // un error para la vista.
            if (!$producto) {
                $error = "Producto no encontrado.";
            }

            require __DIR__ . '/../Views/productos/eliminar.php';
        }

        // 21. Maneja el proceso de eliminar un producto 
        // tras confirmar en el formulario.
        public function procesarEliminar() {
            $id = filtrarEntero($_POST['id'] ?? 0);

            // 22. Llamo al modelo para eliminar el 
            // producto y redirijo con un mensaje.
            if ($this->productoModel->eliminar($id)) {
                header("Location: index.php?controller=producto&action=lista&message=Producto+eliminado");
            } else {
                $error = "Error al eliminar el producto.";
                require __DIR__ . 
                '/../Views/productos/eliminar.php';
            }
        }
    }
?>
