<?php
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../helpers/seguridad.php';

class UsuarioController {
    private $usuarioModel;

    public function __construct($conn) {
        $this->usuarioModel = new UsuarioModel($conn);
    }

    public function login() {
        require __DIR__ . '/../Views/usuarios/login.php';
    }

    public function procesarLogin() {
        $email = filtrarEmail($_POST['email'] ?? '');
        $contraseña = $_POST['contraseña'] ?? '';

        $user = $this->usuarioModel->obtenerPorEmail($email);
        if ($user && password_verify($contraseña, $user['contraseña'])) {
            session_start();
            $_SESSION['id_usuario'] = $user['id'];
            $_SESSION['nombre_usuario'] = $user['nombre'];
            $_SESSION['admin'] = $user['admin']; // Guardamos el rol en la sesión
            header("Location: index.php");
        } else {
            $error = "Email o contraseña incorrectos.";
            require __DIR__ . '/../Views/usuarios/login.php';
        }
    }

    public function registro() {
        require __DIR__ . '/../Views/usuarios/registro.php';
    }

    public function procesarRegistro() {
        $nombre = filtrarTexto($_POST['nombre'] ?? '');
        $email = filtrarEmail($_POST['email'] ?? '');
        $contraseña_plana = $_POST['contraseña'] ?? '';
        $contraseña = password_hash($contraseña_plana, PASSWORD_DEFAULT);

        // Si el checkbox admin está marcado, verificar la contraseña admin
        $admin = isset($_POST['admin']) ? 1 : 0;
        $admin_password = $_POST['admin_password'] ?? '';

        if ($admin === 1) {
            // Verificamos la contraseña fija para el admin
            if ($admin_password !== '000000') {
                $error = "Contraseña de Admin incorrecta. No se ha registrado el usuario.";
                require __DIR__ . '/../Views/usuarios/registro.php';
                return; // Detener la ejecución aquí
            }
        }

        $existe = $this->usuarioModel->obtenerPorEmail($email);
        if ($existe) {
            $error = "El email ya está registrado. Por favor, usa otro.";
            require __DIR__ . '/../Views/usuarios/registro.php';
        } else {
            if ($this->usuarioModel->registrar($nombre, $email, $contraseña, $admin)) {
                // Redirigimos con un mensaje
                header("Location: index.php?controller=usuario&action=login&message=Usuario+registrado+con+éxito");
            } else {
                $error = "Error al registrar el usuario.";
                require __DIR__ . '/../Views/usuarios/registro.php';
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}
