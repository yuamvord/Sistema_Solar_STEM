<?php
include 'conexion.php';

if (isset($_POST['token'], $_POST['password'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];

    // ======================
    // VALIDACIONES DE CONTRASEÑA
    // ======================
    if (strlen($password) < 8) {
        header("Location: reset_password.php?token=$token&error=La contraseña debe tener al menos 8 caracteres");
        exit();
    }
    if (!preg_match('/[A-Z]/', $password)) {
        header("Location: reset_password.php?token=$token&error=La contraseña debe tener al menos una letra mayúscula");
        exit();
    }
    if (!preg_match('/[a-z]/', $password)) {
        header("Location: reset_password.php?token=$token&error=La contraseña debe tener al menos una letra minúscula");
        exit();
    }
    if (!preg_match('/[0-9]/', $password)) {
        header("Location: reset_password.php?token=$token&error=La contraseña debe tener al menos un número");
        exit();
    }
    if (!preg_match('/[\W]/', $password)) {
        header("Location: reset_password.php?token=$token&error=La contraseña debe tener al menos un carácter especial");
        exit();
    }

    // ======================
    // VERIFICAR TOKEN VÁLIDO
    // ======================
    $stmt = $conexion->prepare("SELECT Email FROM users WHERE reset_token=? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: reset_password.php?error=Enlace inválido o expirado");
        exit();
    }

    $row = $result->fetch_assoc();
    $email = $row['Email'];

    // ======================
    // GUARDAR CONTRASEÑA HASHEADA Y ELIMINAR TOKEN
    // ======================
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $update = $conexion->prepare("UPDATE users SET Password=?, reset_token=NULL, token_expiry=NULL WHERE Email=?");
    $update->bind_param("ss", $hash, $email);
    $update->execute();

    // ======================
    // REDIRECCIONAR AL LOGIN
    // ======================
    header("Location: login.php?update=success");
    exit();
}
?>
