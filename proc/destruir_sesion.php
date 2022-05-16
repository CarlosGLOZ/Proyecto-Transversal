<?php
// DESTRUIR LA SESIÓN Y TODOS SUS DATOS Y DEVOLVER AL USUARIO A ACTIVIDADES.PHP
session_start();
session_destroy();
session_abort();

echo "<script>window.location.href = '../view/login.php';</script>";