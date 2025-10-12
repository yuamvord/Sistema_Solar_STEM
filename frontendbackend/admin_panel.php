<!--!
  @file admin_panel.php
  @brief Panel de aprobación de cuentas
  @details 
  Este archivo contiene el panel de control donde se aprobaran las cuentas que puedan
  utilizar el sistema STEM
  @author
  Dream Team Systems
  @date
  Octubre 2025
--->
<?php
/**
 * @file admin_panel.php
 * @brief Establece el dashboard de aprobación de cuentas
 * @details Este archivo contiene las funciones necesarias para
 *          realizar la aprobación de cuentas de DTS
 * @author Dream Team Systems
 * @date Octubre 2025
 */
include('conexion.php'); 

/** @brief Realiza la aprobación de usuarios 
 * @details Consulta al usuario en la base de datos y lo desplega en una lista, si se presiona
 *         el boton de aprobado retorna el mensaje de aprobacion
 * @return string Usuario aprobado correctamente
*/
if (isset($_GET['Aprobar'])) {
    $id = $_GET['Aprobar'];
    $sql = "UPDATE users SET Aprobado = 1 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "<script>alert('Usuario aprobado correctamente'); window.location='admin_panel.php';</script>";
}

/** @brief Muestra los usuarios de la base de datos */
$result = $conexion->query("SELECT id, Nombre_Completo, Username, Email, Aprobado FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        table { width: 90%; margin: 30px auto; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        a { text-decoration: none; color: #007bff; }
        a.button { padding: 6px 10px; background: #28a745; color: white; border-radius: 4px; }
        a.button:hover { background: #218838; }
    </style>
</head>
<body>
<!--! @section main Panel de control para aprobación de cuentas -->
<h2 style="text-align:center;">Panel de Administración - Aprobación de Usuarios</h2>
<!--! @article tabla Tabla de usuarios para mantenerlos organizados --->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Aprobado</th>
        <th>Acción</th>
    </tr>
    <!---! @article usuarios Muestra los usuarios que han creado una cuenta para realizar la aprobación --->
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['Nombre_Completo']; ?></td>
        <td><?php echo $row['Username']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td><?php echo $row['Aprobado'] ? 'Sí' : 'No'; ?></td>
        <td>
            <?php if (!$row['Aprobado']) { ?>
                <a class="button" href="admin_panel.php?Aprobar=<?php echo $row['id']; ?>">Aprobar</a>
            <?php } else { ?>
                ✅ Aprobado
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>

<!--!
  @file admin_panel.php
  @brief Panel de aprobación de cuentas
  @details 
  Este archivo contiene el panel de control donde se aprobaran las cuentas que puedan
  utilizar el sistema STEM
  @author
  Dream Team Systems
  @date
  Octubre 2025
--->
<?php
/**
 * @file admin_panel.php
 * @brief Establece el dashboard de aprobación de cuentas
 * @details Este archivo contiene las funciones necesarias para
 *          realizar la aprobación de cuentas de DTS
 * @author Dream Team Systems
 * @date Octubre 2025
 */
include('conexion.php'); 

/** @brief Realiza la aprobación de usuarios 
 * @details Consulta al usuario en la base de datos y lo desplega en una lista, si se presiona
 *         el boton de aprobado retorna el mensaje de aprobacion
 * @return string Usuario aprobado correctamente
*/
if (isset($_GET['Aprobar'])) {
    $id = $_GET['Aprobar'];
    $sql = "UPDATE users SET Aprobado = 1 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "<script>alert('Usuario aprobado correctamente'); window.location='admin_panel.php';</script>";
}

/** @brief Muestra los usuarios de la base de datos */
$result = $conexion->query("SELECT id, Nombre_Completo, Username, Email, Aprobado FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        table { width: 90%; margin: 30px auto; border-collapse: collapse; background: #fff; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        a { text-decoration: none; color: #007bff; }
        a.button { padding: 6px 10px; background: #28a745; color: white; border-radius: 4px; }
        a.button:hover { background: #218838; }
    </style>
</head>
<body>
<!--! @section main Panel de control para aprobación de cuentas -->
<h2 style="text-align:center;">Panel de Administración - Aprobación de Usuarios</h2>
<!--! @article tabla Tabla de usuarios para mantenerlos organizados --->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Aprobado</th>
        <th>Acción</th>
    </tr>
    <!---! @article usuarios Muestra los usuarios que han creado una cuenta para realizar la aprobación --->
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['Nombre_Completo']; ?></td>
        <td><?php echo $row['Username']; ?></td>
        <td><?php echo $row['Email']; ?></td>
        <td><?php echo $row['Aprobado'] ? 'Sí' : 'No'; ?></td>
        <td>
            <?php if (!$row['Aprobado']) { ?>
                <a class="button" href="admin_panel.php?Aprobar=<?php echo $row['id']; ?>">Aprobar</a>
            <?php } else { ?>
                ✅ Aprobado
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
