<?php
    // 1. Esta función limpia y escapa el texto para 
    // proteger contra ataques XSS y eliminar 
    // espacios extra.
    function filtrarTexto($campo) {
        return htmlspecialchars(
            trim($campo), 
            ENT_QUOTES, 
            'UTF-8'
        );
    }

    // 2. Esta función filtra y sanea emails, 
    // utilizando filter_var y luego escapando 
    // caracteres peligrosos.
    function filtrarEmail($campo) {
        $campo = 
        filter_var(
            $campo, 
            FILTER_SANITIZE_EMAIL
        );
        return htmlspecialchars(
            trim($campo), 
            ENT_QUOTES, 
            'UTF-8'
        );
    }

    // 3. Esta función intenta convertir el valor a 
    // un entero válido, devolviendo false si no es 
    // un entero.
    function filtrarEntero($campo) {
        return filter_var(
            $campo, 
            FILTER_VALIDATE_INT
        );
    }

    // 4. Esta función intenta convertir el valor a 
    // un número decimal válido, devolviendo false 
    // si no lo es.
    function filtrarDecimal($campo) {
        return filter_var(
            $campo, 
            FILTER_VALIDATE_FLOAT
        );
    }
?>
