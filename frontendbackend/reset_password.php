<link rel="stylesheet" href="reset_style.css">
<div class="reset-card">
    <?php
    include 'conexion.php';

    // Mostrar mensaje de error si existe
    if (isset($_GET['error'])) {
        echo '<div class="error-message">'.htmlspecialchars($_GET['error']).'</div>';
    }

    if (isset($_GET['token'])) {
        $token = $_GET['token'];

        // Verificar token válido y vigente
        $query = $conexion->prepare("SELECT Email FROM users WHERE reset_token=? AND token_expiry > NOW()");
        $query->bind_param("s", $token);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
    ?>
            <form action="update_password.php" method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <label>Nueva contraseña:</label><br>
                <input type="password" name="password" required><br>
                <button type="submit">Actualizar</button>
            </form>
    <?php
        } else {
            echo '<div class="error-message">Enlace inválido o expirado.</div>';
        }
    }
    ?>
</div>
