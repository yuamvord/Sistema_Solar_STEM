<?php
/**
 * @file conexion.php
 * @brief Establece la conexión con la base de datos MySQL.
 * @details Este archivo contiene las funciones necesarias para conectarse
 *          al servidor de base de datos y manejar errores de conexión.
 * @author Dream Team Systems
 * @date Octubre 2025
 */


/** @var string $host Nombre del servidor de la base de datos */
$host = "localhost";
/** @var string $user Nombre del usuario que administra la base de datos */
$user = "root";
/** @var string $pass Contraseña de la base de datos para conexión */
$pass = "";   
/** @var string $db Nombre de la base de datos */ 
$db   = "dreamteam";

$conexion = mysqli_connect($host, $user, $pass, $db);
/**
 * @brief Verifica si la conexion es satisfactoria, si no se ejecuta
 * @details Envia el mensaje de error de conexión
 * @return Error de conexión a la base de datos
 */
if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");
?>
