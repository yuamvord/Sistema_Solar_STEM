<?php
/**
 * @file register_process.php
 * @brief Estable el registro de nuevos usuarios
 * @details Este archivo contiene las funciones necesarias
 *          para un correcto registro de nuevos usuarios
 * @author Dream Team Systems
 * @date Octubre 2025
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once "conexion.php";
/** @brief Se realiza la importación del sistema Twilio */
require '../vendor/autoload.php'; 

use Twilio\Rest\Client;

/** @brief Si la persona intenta entrar por un metodo distinto a POST no se ejecuta el script */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: Login.php"); 
    exit();
}

function validate($data)
{
    return htmlspecialchars(trim($data));
}

/** @var string $nombre Realiza la validación de datos de la variable de nombre */
$nombre = isset($_POST['Nombre_Completo']) ? validate($_POST['Nombre_Completo']) : '';
/** @var string $username Realiza la validación de datos de la variable de usuario */
$username = isset($_POST['Username']) ? validate($_POST['Username']) : '';
/** @var string $email Realiza la validación de datos de la variable email */
$email = isset($_POST['Email']) ? strtolower(trim($_POST['Email'])) : '';
/** @var string $password Realiza la validación de datos de la variable password */
$password = isset($_POST['Password']) ? $_POST['Password'] : '';
/** @var string $password2 Realiza la validación de datos de la varible password2
 *                         para que concuerde con la variable password
 */
$password2 = isset($_POST['Password2']) ? $_POST['Password2'] : '';

/**
 * @brief Verifica que los datos ingresados por el usuario no esten vacios
 * @return string Todos los campos son requeridos
 */
if (empty($nombre) || empty($username) || empty($email) || empty($password) || empty($password2)) {
    header("Location: Login.php?error=Todos los campos son requeridos");
    exit();
}

/**
 * @brief Realiza una validación del correo electronico para saber si es correcto
 * @return string Email no válido
 */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: Login.php?error=Email no válido");
    exit();
}

/**
 * @brief Realiza la comparación de las contraseñas ingresadas
 * @details Si las contraseñas ingresadas por el usuario no concuerda retorna el mensaje
 * @return string Las contraseñas no coincide
 */
if ($password !== $password2) {
    header("Location: Login.php?error=Las contraseñas no coinciden");
    exit();
}

/**
 * @brief Realiza la validación de la cantidad de caracteres de la contraseña
 * @details Si la contraseña cuenta con menos de 8 caracteres no la acepta
 * @return string La contraseña debe tener al menos 8 caracteres
 */
if (strlen($password) < 8) {
    header("Location: Login.php?error=La contraseña debe tener al menos 8 caracteres");
    exit();
}

/**
 * @brief Verifica que el usuario o el Email no existan en la base de datos
 * @details Si dichos datos ya existen retornara un mensaje de error
 * @return string Usuario o correo ya registrado
 */
$sql_check = "SELECT Id FROM Users WHERE Username = ? OR Email = ? LIMIT 1";
if ($stmt = mysqli_prepare($conexion, $sql_check)) {
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_close($stmt);
        header("Location: Login.php?error=Usuario o correo ya registrado");
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    header("Location: Login.php?error=Error interno");
    exit();
}
/** @brief Se realiza la inserción en la base de datos */
$hash = password_hash($password, PASSWORD_DEFAULT);
$sql_insert = "INSERT INTO Users (Nombre_Completo, Username, Email, Password, Aprobado) VALUES (?, ?, ?, ?, 0)";
if ($stmt = mysqli_prepare($conexion, $sql_insert)) {
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $username, $email, $hash);
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        
        /** @var string $sid Es el ID del usuario de Twilio a quien llegara el mensaje de acceso */
        $sid = ' ';
        /** @var string $token Es el token que brinda Twilio para validar la cuenta */
        $token = ' ';
        $client = new Client($sid, $token);

        /** @brief Envía el mensaje por whatsapp al número del usuario registrado en Twilio */
        $client->messages->create(
            'whatsapp:+50255705760', 
            [
                /** @brief Número oficial de Twilio desde el cual se enviara el mensaje de aprobación */
                'from' => 'whatsapp:+14155238886', 
                'body' => "Nuevo registro de usuario pendiente de aprobación:\nNombre: $nombre\nUsuario: $username\nEmail: $email"
            ]
        );


        header("Location: Login.php?success=Cuenta creada correctamente. Puedes acceder cuando hayas sido aprobado");
        exit();
    } else {
        mysqli_stmt_close($stmt);
        header("Location: Login.php?error=No se pudo crear la cuenta");
        exit();
    }
} else {
    header("Location: Login.php?error=Error interno");
    exit();
}
