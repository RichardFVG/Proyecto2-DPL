<?php
    // Declaración de las credenciales 
    // del servidor y base de datos
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "tienda_medica";
    // Creación de la conexión a la 
    // base de datos usando la clase 
    // mysqli
    $conn = new mysqli(
        $servername,  
        $username,    
        $password,    
        $dbname       
    );
    // Verificación de errores en la 
    // conexión
    if ($conn->connect_error) {
        // Si ocurre un error, termina 
        // el script y muestra un mensaje 
        // de error
        die(
            "Conexión fallida: " . 
            $conn->connect_error
        );
    }
    // Configuración del conjunto de 
    // caracteres para la conexión (UTF-8)
    $conn->set_charset("utf8");
?>

