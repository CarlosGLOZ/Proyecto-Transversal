<?php

function val_sesion() {
    session_start();
    if (!isset($_SESSION['email_prof'])) {
        echo "<script>window.location.href = '../view/login.php'</script>";
        die();
    }
}