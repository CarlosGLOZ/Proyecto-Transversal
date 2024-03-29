<?php

// comprobar que los datos han sido introducidos en el formulario, redirigir al login con un GET de validación falsa
if ((isset($_POST['email_login']) && isset($_POST['password_login'])) && (!empty($_POST['email_login']) && !empty($_POST['password_login'])))    {
    require "./conexion.php";

    // SI EL USUARIO YA ESTÁ LOGUEADO CON EL MAIL INTRODUCIDO Y HA HECHO LA VALIDACIÓN EN DOS PASOS, ENVIARLO  A index.php
    if (isset($_SESSION['2step_val']) && isset($_SESSION['2step_val']) && $_SESSION['email_prof'] == $_POST['email_login']) {
        echo "<script>window.location.href = '../view/index.php'</script>";
        die();
    }

    // EVITAR INJECCIÓN SQL
    $email_login = $conexion->real_escape_string($_POST['email_login']);
    $password_login = $conexion->real_escape_string($_POST['password_login']);

    // // ENCRIPTAR PASSWORD si no es una cuenta de testeo
    // if ($email_login !== '100007082.joan23@fje.edu') {
    //     $password_login = sha1($password_login);
    // }

    $password_login = sha1($password_login);

    // COMPROBAR LA CONEXIÓN A LA BDD
    if (!$conexion) {
        echo "ERROR DE CONEXION CON LA BASE DE DATOS";
        echo "<a href='../view/login.php?err=cnxBDD'>volver</a>";
        die();
    }

    // QUERY PARA VER SI EXISTE UN USUARIO CON ESOS DATOS
    $query = "SELECT * FROM tbl_professor WHERE email_prof = '{$email_login}' AND contra = '{$password_login}';";
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
            $_SESSION['2step_val'] = false;
        }

        // enviar código de verificación
        require "2step_auth.php";

        twostep_auth($_SESSION['email_prof']);

        echo "<script>localStorage.setItem('nombre_usuario', '{$_SESSION['nom_prof']}' )</script>";
        echo "<script>window.location.href = '../view/codigo_auth.html';</script>";
        die();
    } else {
        echo "<script>window.location.href = '../view/login.php?val=false';</script>";
        die();
    }
} else {
    echo "<script>window.location.href = '../view/login.php?dat=false'</script>";
    die();
}