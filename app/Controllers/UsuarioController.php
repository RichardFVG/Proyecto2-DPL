<?php
// 1. Incluyo el modelo de usuarios y las funciones 
// de seguridad, que necesitaré para este 
// controlador.
require_once __DIR__ . '/../Models/UsuarioModel.php';
require_once __DIR__ . '/../helpers/seguridad.php';

// 2. Defino la clase UsuarioController para manejar 
// todo lo relacionado con el inicio de sesión y 
// registro.
class UsuarioController {
    // 3. Declaro una propiedad para almacenar el 
    // modelo de usuarios.
    private $usuarioModel;

    // 4. En el constructor, recibo la conexión y 
    // creo una instancia del modelo de usuarios.
    public function __construct($conn) {
        $this->usuarioModel = new UsuarioModel($conn);
    }

    // 5. Muestro el formulario de login.
    public function login() {
        require __DIR__ . '/../Views/usuarios/login.php';
    }

    // 6. Proceso la información del formulario de 
    // login y verifico la autenticación.
    public function procesarLogin() {
        $email = filtrarEmail($_POST['email'] ?? '');
        $contraseña = $_POST['contraseña'] ?? '';

        // 7. Busco al usuario en la base de datos 
        // según su email.
        $user = $this->usuarioModel->obtenerPorEmail($email);

        // 8. Verifico que el usuario exista y 
        // la contraseña sea correcta mediante 
        // password_verify.
        if ($user && password_verify($contraseña, $user['contraseña'])) {
            session_start();
            $_SESSION['id_usuario'] = $user['id'];
            $_SESSION['nombre_usuario'] = $user['nombre'];

            // 9. Guardo el rol de admin (o no) 
            // en la sesión para un control más fino.
            $_SESSION['admin'] = $user['admin'];

            header("Location: index.php");
        } else {
            // 10. Si falla la autenticación, muestro 
            // un mensaje de error.
            $error = "Email o contraseña incorrectos.";
            require __DIR__ . '/../Views/usuarios/login.php';
        }
    }

    // 11. Muestro el formulario de registro.
    public function registro() {
        require __DIR__ . '/../Views/usuarios/registro.php';
    }

    // 12. Proceso los datos del formulario de 
    // registro para crear una nueva cuenta.
    public function procesarRegistro() {
        $nombre = filtrarTexto($_POST['nombre'] ?? '');
        $email = filtrarEmail($_POST['email'] ?? '');
        $contraseña_plana = $_POST['contraseña'] ?? '';

        // 13. Cifro la contraseña antes de 
        // guardarla en la base de datos.
        $contraseña = password_hash($contraseña_plana, PASSWORD_DEFAULT);

        // 14. Verifico si el usuario desea ser 
        // admin marcando el checkbox y, si es así, 
        // pido la clave fija.
        $admin = isset($_POST['admin']) ? 1 : 0;
        $admin_password = $_POST['admin_password'] ?? '';

        // 15. Si marcó la opción admin, reviso si 
        // la contraseña para admin es correcta.
        if ($admin === 1) {
            if ($admin_password !== '000000') {
                $error = "Contraseña de Admin incorrecta. No se ha registrado el usuario.";
                require __DIR__ . '/../Views/usuarios/registro.php';
                return;
            }
        }

        // 16. Verifico si el email ya está en uso.
        $existe = $this->usuarioModel->obtenerPorEmail($email);

        if ($existe) {
            $error = "El email ya está registrado. Por favor, usa otro.";
            require __DIR__ . '/../Views/usuarios/registro.php';
        } else {
            // 17. Intento registrar el usuario en la 
            // base de datos con los datos proporcionados.
            if ($this->usuarioModel->registrar($nombre, $email, $contraseña, $admin)) {
                // 18. Redirijo al formulario de login 
                // con un mensaje de éxito.
                header("Location: index.php?controller=usuario&action=login&message=Usuario+registrado+con+éxito");
            } else {
                // 19. En caso de error al insertar en la 
                // base de datos, muestro el mensaje.
                $error = "Error al registrar el usuario.";
                require __DIR__ . '/../Views/usuarios/registro.php';
            }
        }
    }

    // 20. Cierro la sesión y redirijo a la página 
    // principal.
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
    }
}
?>
