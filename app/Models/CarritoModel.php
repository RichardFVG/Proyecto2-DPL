<?php
// 1. Defino la clase CarritoModel, que se 
// encarga de gestionar la tabla 'carrito' 
// en la base de datos.
class CarritoModel {
    // 2. Almaceno la conexión a la base de 
    // datos en una propiedad privada.
    private $conn;

    // 3. En el constructor, recibo la 
    // conexión y la asigno a la propiedad 
    // $conn.
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 4. Este método agrega un producto al 
    // carrito. Si ya existe, incrementa la 
    // cantidad.
    public function agregarAlCarrito($id_usuario, $id_producto, $cantidad = 1) {
        $sql = "SELECT * FROM carrito WHERE id_usuario = ? AND id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id_usuario, $id_producto);
        $stmt->execute();
        $res = $stmt->get_result();

        // 5. Si el producto ya está en el 
        // carrito, actualizo la cantidad. 
        // Si no, lo inserto.
        if ($res->num_rows > 0) {
            $sql = "UPDATE carrito 
                    SET cantidad = cantidad + ? 
                    WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $cantidad, $id_usuario, $id_producto);
        } else {
            $sql = "INSERT INTO carrito (id_usuario, id_producto, cantidad) 
                    VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
        }
        return $stmt->execute();
    }

    // 6. Obtengo todos los productos que un 
    // usuario tiene en su carrito, incluyendo 
    // nombre, precio e imagen.
    public function obtenerCarrito($id_usuario) {
        $sql = "SELECT c.id_carrito, p.nombre, p.precio, p.imagen, c.cantidad 
                FROM carrito c
                INNER JOIN productos p ON c.id_producto = p.id
                WHERE c.id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // 7. Elimino una línea específica del carrito, 
    // usando el id_carrito como identificador.
    public function eliminarDelCarrito($id_carrito) {
        $sql = "DELETE FROM carrito WHERE id_carrito = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_carrito);
        return $stmt->execute();
    }

    // 8. Vacío todo el carrito de un usuario, 
    // eliminando todos los registros para ese 
    // id_usuario.
    public function vaciarCarrito($id_usuario) {
        $sql = "DELETE FROM carrito WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }

    // 9. Obtengo una sola línea del carrito 
    // (un producto en particular) usando 
    // id_carrito.
    public function obtenerLineaCarrito($id_carrito) {
        $sql = "SELECT * FROM carrito WHERE id_carrito = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_carrito);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 10. Actualizo la cantidad de un producto 
    // específico del carrito.
    public function actualizarCantidad($id_carrito, $cantidad) {
        $sql = "UPDATE carrito 
                SET cantidad = ? 
                WHERE id_carrito = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cantidad, $id_carrito);
        return $stmt->execute();
    }
}
?>
