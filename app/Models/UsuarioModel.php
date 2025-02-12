<?php
// 1. Defino la clase UsuarioModel, encargada 
// de gestionar la tabla 'usuarios' en la base 
// de datos.
class UsuarioModel {
    // 2. Guardo la conexión a la base de datos 
    // en la propiedad privada $conn.
    private $conn;

    // 3. Al construir la clase, recibo la 
    // conexión y la asigno a $conn.
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 4. Obtengo un usuario por su email, para 
    // validarlo en login o comprobar si existe.
    public function obtenerPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 5. Registro un nuevo usuario con nombre, 
    // email, contraseña encriptada y rol 
    // (admin o no).
    public function registrar($nombre, $email, $contraseña, $admin) {
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, admin) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $email, $contraseña, $admin);
        return $stmt->execute();
    }
}
?>
