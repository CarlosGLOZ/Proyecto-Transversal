<?php
require "validar_sesion.php";
session_start();

if (isset($_SESSION['email_prof']) && isset($_POST['codigo']) && isset($_SESSION['codigo_auth'])) {
    if ($_POST['codigo'] == $_SESSION['codigo_auth']) {
        $_SESSION['2step_val'] = true;
        echo "<script>window.location.href = '../view/index.php'</script>";
    } else {
        echo "<script>window.location.href = '../view/codigo_auth.html?val=false'</script>";
    }
} else {
    echo "<script>window.location.href = '../view/login.php'</script>";
}