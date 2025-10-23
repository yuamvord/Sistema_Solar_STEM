<?php
/**
 * @file admin_panel.php
 * @brief Panel de aprobación de cuentas
 * @details Este archivo contiene el panel de control donde se aprueban o bloquean las cuentas.
 * @author
 * Dream Team Systems
 * @date Octubre 2025s
 */

 /** @brief Se realiza la conexión a la base de datos */
require_once "conexion.php"; 

/** @brief Realiza el cambio al valor 1 para que el usuario este aprobado */
if (isset($_GET['Aprobar'])) {
    $id = $_GET['Aprobar'];
    $sql = "UPDATE users SET Aprobado = 1 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "<script>alert('Usuario aprobado correctamente'); window.location='admin_panel.php';</script>";
    exit;
} 

/** @brief Realiza el cambio al valor 0 para que el usuario este bloqueado */
if (isset($_GET['Bloquear'])) {
    $id = $_GET['Bloquear'];
    $sql = "UPDATE users SET Aprobado = 0 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "<script>alert('Usuario bloqueado correctamente'); window.location='admin_panel.php';</script>";
    exit;
}


$result = $conexion->query("SELECT id, Nombre_Completo, Username, Email, Aprobado FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <!--! @section Estilos de la tabla del panel de control --->
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        table { width: 90%; margin: 30px auto; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        a { text-decoration: none; color: #007bff; }
        a.button { padding: 6px 10px; background: #28a745; color: white; border-radius: 4px; margin-right: 5px; }
        a.button.block { background: #dc3545; } /* Rojo para bloquear */
        a.button:hover { opacity: 0.85; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Panel de Administración - Aprobación de Usuarios</h2>
<!--! Imprime la tabla con los usuario registrados -->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Aprobado</th>
        <th>Acción</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['Nombre_Completo']); ?></td>
        <td><?php echo htmlspecialchars($row['Username']); ?></td>
        <td><?php echo htmlspecialchars($row['Email']); ?></td>
        <td><?php echo $row['Aprobado'] ? 'Sí' : 'No'; ?></td>
        <td>
            <?php if ($row['Aprobado'] == 0) { ?>
                <a class="button" href="admin_panel.php?Aprobar=<?php echo $row['id']; ?>">Aprobar</a>
            <?php } else { ?>
                <a class="button block" href="admin_panel.php?Bloquear=<?php echo $row['id']; ?>">Bloquear</a>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
