<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../css/login.css">
    <!-- JAVASCRIPT -->
    <script type="text/javascript" src="../js/login.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/e0b63cee0f.js" crossorigin="anonymous"></script>
    <!-- TIPO DE LETRA: -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz@8..144&display=swap" rel="stylesheet">
</head>

<body>
    <div class="flip-container">
        <div class="flipper" id="flipper">
            <div class="front">
                <h1>Administración alumnado y profesorado - Joan XXIII</h1>
                <img src="../img/jesuiteseducacio-1.png" alt=""><br><br>
                <!-- <a class="flipbutton" id="infoButton" href="#">Iniciar sesión</a> -->
                <a class="flipbutton" id="infoButton" href='#'><button style="margin-top: 7%;" class="btn_enviar">Iniciar sesión</button></a>
            </div>

            <div class="back">
                <a class="flipbutton" id="loginButton" href="#"><button class="btn" type='button'><</button></a>
                <div class="login">
                    <h1 class="title">Inicio de Sesión:</h1>
                    <p>Introduce tus credenciales para poder entrar en la aplicación y administrar los usuarios de la escuela. Recuerda que tan solo podrás entrar si eres professor o personal administrativo, si eres alumno no podrás acceder :)</p>
                    <form action="../proc/validar_login.php" method="post">
                        <input name="email_login" type="email" placeholder="Correo electrónico" />
                        <input name="password_login" type="password" placeholder="Contraseña" /><br><br>
                        <?php
                        if (isset($_GET['dat'])) {
                            echo "<p style='margin-top: 0%; color: red;'>Nos has introducido alguno de los datos, rellenalos y prueba otra vez!</p>";
                        }
                        if (isset($_GET['val'])) {
                            echo "<p style='margin-top: 0%; color: red;'>Los valores introducidos no són correctos, prueba otra vez!</p>";
                        }
                        ?>
                        <button style="margin-top: 2%;" class="btn_enviar">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>