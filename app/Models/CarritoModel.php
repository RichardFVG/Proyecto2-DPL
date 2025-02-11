<?php
// app/Models/CarritoModel.php
class CarritoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function agregarAlCarrito($id_usuario, $id_producto, $cantidad = 1) {
        $sql = "SELECT * FROM carrito WHERE id_usuario = ? AND id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id_usuario, $id_producto);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows > 0) {
            $sql = "UPDATE carrito SET cantidad = cantidad + ? WHERE id_usuario = ? AND id_producto = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $cantidad, $id_usuario, $id_producto);
        } else {
            $sql = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
        }
        return $stmt->execute();
    }

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

    public function eliminarDelCarrito($id_carrito) {
        $sql = "DELETE FROM carrito WHERE id_carrito = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_carrito);
        return $stmt->execute();
    }

    public function vaciarCarrito($id_usuario) {
        $sql = "DELETE FROM carrito WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        return $stmt->execute();
    }

    // Nuevo método para obtener una sola línea del carrito
    public function obtenerLineaCarrito($id_carrito) {
        $sql = "SELECT * FROM carrito WHERE id_carrito = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_carrito);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Nuevo método para actualizar la cantidad de un producto en el carrito
    public function actualizarCantidad($id_carrito, $cantidad) {
        $sql = "UPDATE carrito SET cantidad = ? WHERE id_carrito = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cantidad, $id_carrito);
        return $stmt->execute();
    }
}
