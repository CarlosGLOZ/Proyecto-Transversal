<?php

// comprobar que los datos han sido introducidos en el formulario, redirigir al login con un GET de validación falsa
if (isset($_POST['email_login']) && isset($_POST['email_login']))    {
    require "./conexion.php";

    $email_login = $_POST['email_login'];
    $password_login = sha1($_POST['password_login']);

    // COMPROBAR LA CONEXIÓN A LA BDD (por alguna razón??)
    if (!$conexion) {
        echo "ERROR DE CONEXION CON LA BASE DE DATOS";
        echo "<a href='../view/login.php'>volver</a>";
        die();
    }

    // QUERY PARA VER SI EXISTE UN USUARIO CON ESOS DATOS
    $query = "SELECT * FROM tbl_professor WHERE email_prof = '{$email_login}' AND contra = '{$password_login}'";
    $valid_login = mysqli_query($conexion, $query);

    $match = $valid_login -> num_rows;

    if ($match === 1) {
        session_start();

        // ESTABLECER VARIABLES DE SESIÓN
        foreach ($valid_login as $key => $user) {
            $_SESSION['id_professor'] = $user['id_professor'];
            $_SESSION['email_prof'] = $user['email_prof'];
            $_SESSION['contra'] = $user['contra'];
            $_SESSION['nom_prof'] = $user['nom_prof'];
            $_SESSION['admin'] = $user['admin'];
        }

        echo "<script>window.location.href = '../view/';</script>";
    } else {
        echo "<script>window.location.href = '../view/login.php?val=false';</script>";
        die();
    }
} else {
    echo "<script>window.location.href = '../view/login.php?val=false'</script>";
    die();
}