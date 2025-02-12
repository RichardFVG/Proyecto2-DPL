<?php
// 1. Defino la clase ProductoModel para manejar 
// todas las operaciones con la tabla 'productos'.
class ProductoModel {
    // 2. Guardo la conexión a la base de datos 
    // en la propiedad privada $conn.
    private $conn;

    // 3. En el constructor, recibo la conexión 
    // y la asigno a $conn.
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // 4. Este método devuelve todos los 
    // productos en la tabla 'productos'.
    public function obtenerTodos() {
        $sql = "SELECT * FROM productos";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // 5. Obtengo los datos de un producto 
    // específico por su ID.
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 6. Inserto un nuevo producto en la base 
    // de datos, recibiendo nombre, descripción, 
    // precio e imagen.
    public function agregar($nombre, $descripcion, $precio, $imagen) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);
        return $stmt->execute();
    }

    // 7. Edito un producto existente, 
    // actualizando tanto sus datos como la 
    // imagen si corresponde.
    public function editar($id, $nombre, $descripcion, $precio, $imagen) {
        $sql = "UPDATE productos 
                SET nombre = ?, descripcion = ?, precio = ?, imagen = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $imagen, $id);
        return $stmt->execute();
    }

    // 8. Elimino un producto de la tabla 
    // usando su ID.
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
