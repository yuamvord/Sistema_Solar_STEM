// verificar_sesion.js

function verificarEstado() {
    fetch('frontendbackend/verificar_estado.php')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'blocked') {
                alert('Tu cuenta ha sido bloqueada por un administrador.');
                window.location = 'frontendbackend/Login.php';
            } else if (data.status === 'no_session') {
                window.location = 'frontendbackend/Login.php';
            }
        })
        .catch(err => console.error('Error al verificar estado:', err));
}

// Verificación periódica cada 5 segundos
setInterval(verificarEstado, 5000);

// Verificación al hacer clic en cualquier enlace o botón
document.addEventListener('click', verificarEstado);
