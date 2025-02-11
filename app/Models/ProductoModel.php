<?php
class ProductoModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM productos";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function agregar($nombre, $descripcion, $precio, $imagen) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);
        return $stmt->execute();
    }

    // Ajustamos el método editar para aceptar la imagen
    public function editar($id, $nombre, $descripcion, $precio, $imagen) {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
