<?php  
/**
 * @file cerrarsesion.php
 * @brief Establece el cierre de sesión de la web
 * @details Este archivo contiene las funciones necesarias para
 *          el cierre de sesión exitosa
 * @author Dream Team Systems
 * @date Octubre 2025
 */


/** @brief Realiza el cierra de sesión */
session_start();
$_SESSION = [];
session_unset();

session_destroy();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

header("Location: Login.php");
exit();