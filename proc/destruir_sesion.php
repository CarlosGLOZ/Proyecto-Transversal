<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // DESTRUIR LA SESIÓN Y TODOS SUS DATOS Y DEVOLVER AL USUARIO A ACTIVIDADES.PHP
    session_start();
    session_destroy();
    session_abort();

    ?>

    <!-- SCRIPT PARA REDIRIGIR AL INDEX UNA VEZ HAYAMOS CERRADO/ELIMINADO LA SESIÓN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    function aviso(url) {
                        Swal.fire({
                                title: 'Se ha cerrado sesión correctamente!',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Volver'
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = url;
                                }
                            })
                    }
                aviso('../view/login.php');
    </script>
</body>
</html>
