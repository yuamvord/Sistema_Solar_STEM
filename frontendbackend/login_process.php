<?php
/**
 * @file login_process.php
 * @brief Establece el inicio de sesión del usuario
 * @details Este archivo contiene los parametros y funciones
 *          necesarias para una correcta validación de inicio de sesión
 * @author Dream Team Systems
 * @date Octubre 2025
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
/** @brief Realiza la conexión con la base de datos */
require_once "conexion.php"; 

/** @brief Si la persona intenta entrar por un metodo distinto a POST no se ejecuta el script */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: Login.php"); 
    exit();
}

function validate($data) {
    return htmlspecialchars(trim($data));
}

/** @var string $identifier Define el identificador unico de inicio de sesión */
$identifier = isset($_POST['identifier']) ? validate($_POST['identifier']) : '';
/** @var string $password Define la variable que almacenara la contraseña del usuario */
$password   = isset($_POST['password']) ? $_POST['password'] : '';

/**
 * @brief Verifica que $identifier y $password no se encuentren vacios
 * @return string Correo y contraseña son requeridos
 */
if (empty($identifier) || empty($password)) {
    header("Location: Login.php?error=Correo y contraseña son requeridos");
    exit();
}

/** @var string $sql Consulta los datos en la base de datos MySQL */
$sql = "SELECT id, Nombre_Completo, Username, Email, Password, Aprobado FROM users WHERE Username = ? OR Email = ? LIMIT 1";
if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $identifier, $identifier);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 1) {
        mysqli_stmt_bind_result($stmt, $id, $nombre, $username, $email, $hash, $aprobado);
        mysqli_stmt_fetch($stmt);

        if (password_verify($password, $hash)) {
            /**
             * @brief Marca al usuario con un 0 para evitar que pueda acceder sin autorizacion
             * @return string Tu cuenta aún no ha sido aprobada
             */
             if ($aprobado == 0) {
                mysqli_stmt_close($stmt);
                header("Location: Login.php?error=Tu cuenta aún no ha sido aprobada");
                exit();
            }

            session_regenerate_id(true);
            $_SESSION['id'] = $id;
            $_SESSION['Username'] = $username;
            $_SESSION['Nombre_Completo'] = $nombre;
            $_SESSION['Email'] = $email;
            
            /** @brief Si el usuario es aprobado lo dirige a la página de inicio de sesión */
            mysqli_stmt_close($stmt);
            header("Location: ../index.php");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            header("Location: Login.php?error=Correo o contraseña incorrectos");
            exit();
        }
    } else {
        mysqli_stmt_close($stmt);
        header("Location: Login.php?error=Correo o contraseña incorrectos");
        exit();
    }
} else {
    header("Location: Login.php?error=Error interno");
    exit();
}
?>
