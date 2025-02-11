<?php
// Funciones auxiliares para seguridad

function filtrarTexto($campo) {
    return htmlspecialchars(trim($campo), ENT_QUOTES, 'UTF-8');
}

function filtrarEmail($campo) {
    $campo = filter_var($campo, FILTER_SANITIZE_EMAIL);
    return htmlspecialchars(trim($campo), ENT_QUOTES, 'UTF-8');
}

function filtrarEntero($campo) {
    return filter_var($campo, FILTER_VALIDATE_INT);
}

function filtrarDecimal($campo) {
    return filter_var($campo, FILTER_VALIDATE_FLOAT);
}
