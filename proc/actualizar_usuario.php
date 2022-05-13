<?php
    session_start();
    if (!isset($_SESSION['nombre_usuario'])) {
        echo "<script>window.location.href = 'login.php'</script>";
    } else {

    }
