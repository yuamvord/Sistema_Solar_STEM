<?php
session_start();
require_once "conexion.php";

$response = ['status' => 'ok'];

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT Aprobado FROM users WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($aprobado);
    $stmt->fetch();
    $stmt->close();

    if ((int)$aprobado === 0) {
        // Usuario bloqueado
        session_unset();
        session_destroy();
        $response = ['status' => 'blocked'];
    }
} else {
    $response = ['status' => 'no_session'];
}

header('Content-Type: application/json');
echo json_encode($response);
