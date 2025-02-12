<?php
    // 1. Declaración de las credenciales 
    // del servidor y base de datos
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "tienda_medica";

    // 2. Creación de la conexión a la 
    // base de datos usando la clase 
    // mysqli
    $conn = new mysqli(
        $servername,  
        $username,    
        $password,    
        $dbname       
    );

    // 3. Verificación de errores en la 
    // conexión
    if ($conn->connect_error) {
        // 4. Si ocurre un error, termina 
        // el script y muestra un mensaje 
        // de error
        die(
            "Conexión fallida: " . 
            $conn->connect_error
        );
    }
    // 5. Configuración del conjunto de 
    // caracteres para la conexión (UTF-8)
    $conn->set_charset("utf8");
?>

