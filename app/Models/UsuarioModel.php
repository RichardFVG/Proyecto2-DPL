<?php
class UsuarioModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function registrar($nombre, $email, $contraseña, $admin) {
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, admin) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $contraseña, $admin);
        return $stmt->execute();
    }
}
