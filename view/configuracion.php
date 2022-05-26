<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración</title>
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- HOJA DE ESTILOS CSS -->
    <link rel="stylesheet" href="../css/conf.css">
    <!-- TIPO DE LETRA -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz@8..144&display=swap" rel="stylesheet">
    <!-- JAVASCRIT -->
    <script src="../js/estilos.js"></script>
</head>
<body id="fondo_div" class="fondo_letra">
    <?php

    include '../proc/validar_sesion.php';
    val_sesion();

    $admin = $_SESSION['admin'];

    ?>
    <!-- NAVBAR -->
    <nav id="fondo_nav" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img style="width: 8%;" src="../img/imagen.png" height="34" alt="JE Logo" />
            <b><a id="nombre-usuario" class="navbar-brand">Página de Personalización - Jesuïtes</a></b>
            <div class="nav-buttons">
                <a href='./index.php'><button class='btn_settings form-control animated-button' type='button'><i class="fa-solid fa fa-mail-reply"></i></button></a>
                <a href='../proc/destruir_sesion.php'><button class='btn btn_logout form-control animated-button' type='button'><i class="fa-solid fa-right-from-bracket fa-lg"></i></button></a>
            </div>
        </div>
    </nav>
    <!-- ******************** -->

    <!--Cuerpo de la web-->
    <div id="width_menu" class="column-nav">
        <div class="icono-menu">
            <img src="../img/open-menu.png" id="icono-menu">
        </div>

        <div class="cont-menu active" id="menu">
            <ul>
                <li><a href="#conf">Configuración página web</a></li>
                <li><a href="#noticias">Noticias</a></li>
                <li><a href="#art-1">Articulo 1</a></li>
                <li><a href="#art-2">Articulo 2</a></li>
                <li><a href="#art-3">Articulo 3</a></li>
                <li><a href="#galeria">Galeria de fotografías</a></li>
            </ul>
        </div>

        <script src="../js/app.js"></script>
    </div>

    <div id="width_div" class="column-75">
<b><hr></b>
        <section class="row padding-s">
            <h3 style="margin-bottom: 1%;"  id="conf"><b>Configuración de la página web:</b></h3>
            <p style="width: 100%;">Personaliza la página web a tu gusto cambiando los colores de cualquier elemento.</p>
            <div style="margin-top: 2%;">
                <div class="column-3">
                    <h4><b>Colores de la web:</b></h4>
                    <h5>Tema:</h5>
                    <p>En esta parte podras personalizar tanto los colores de los botones como el tema de la web.</p>
                    <button onClick="cambiarFondo(value)" value="claro" style="background-color: rgb(203, 203, 203); border-width: 2px; border-color: rgb(147, 147, 147);" class="btn">Claro</button>
                    <button onClick="cambiarFondo(value)" value="oscuro" style="background-color: rgb(105, 105, 105); border-width: 2px; border-color: rgb(52, 52, 52);" class="btn">Oscuro</button>
                    <button onClick="cambiarFondo(value)" value="predeterminado" style="background-color: rgb(125, 162, 205); border-width: 2px; border-color: rgb(65, 118, 199);" class="btn">Predeterminado</button>
                    <h5>Botones:</h5>
                    <button onClick="cambiarBotones(value)" value="rojo" style="background-color: rgb(241, 89, 89); border-width: 2px; border-color: rgb(214, 39, 39);" class="btn">Rojo</button>
                    <button onClick="cambiarBotones(value)" value="verde" style="background-color: rgb(132, 238, 139); border-width: 2px; border-color: rgb(74, 208, 83);" class="btn">Verde</button>
                    <button onClick="cambiarBotones(value)" value="morado" style="background-color: rgb(212, 142, 248); border-width: 2px; border-color: rgb(182, 91, 227);" class="btn">Morado</button>
                    <button onClick="cambiarBotones(value)" value="amarillo" style="background-color: rgb(255, 183, 3); border-width: 2px; border-color: rgb(251, 133, 0);" class="btn">Amarillo</button>
                    <button onClick="cambiarBotones(value)" value="azul" style="background-color: rgb(125, 162, 205); border-width: 2px; border-color: rgb(65, 118, 199);" class="btn">Azul</button>
                </div>

                <div style="margin-right: 3%; margin-left: 3%;" class="column-3">
                    <h4><b>Color de letra:</b></h4>
                    <p>Y en la parte de la derecha podras cambiar el color de la letra de todo la página web para acabar de darle el toque final ;)</p>
                    <input class="fondo_btn" id="color-picker" type="color">
                    <input id="btn_submit" class="btn fondo_btn" onClick="cambiarColorLetra()" type="submit" value="Seleccionar">
                </div>

                <div class="column-3">
                    <img src="../img/jesuites.png" alt="">
                </div>
            </div>
        </section>
<b><hr></b>
        <section class="row padding-s">
            <h3 id="noticias"><b>Noticias de JoanXXIII:</b></h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. In dolorum atque veniam itaque voluptatem ab amet. Vitae suscipit sapiente, modi quae repudiandae sed error. Obcaecati corporis magnam fuga rem qui.</p>
        </section>
            
        <article style="margin-bottom: 30px;" id="art-1" class="fondo_btn padding-s back-light">
            <p>FUNDACIÓN 31/03/2022</p>
            <h4 class="titulo-change">Jesuïtes Bellvitge lanza el Ciclo Superior de Higiene Bucodental en colaboración con la Facultad de Odontología de la Universidad de Barcelona</h4>
            <p>Los alumnos que cursen este nuevo ciclo de la rama sanitaria combinarán clases presenciales en el Centro de Estudios Juan XXIII - Jesuïtes Bellvitge y clases prácticas en las instalaciones de la Facultad de Odontología, ubicada en el campus universitario Bellvitge de la Universidad de Barcelona ( UB). Asimismo recibirán formación tanto de profesorado de la escuela como de la facultad.</p>
        </article>
        <article style="margin-bottom: 30px;" id="art-2" class="fondo_btn padding-s back-light">
            <p>FUNDACIÓN 08/03/2022</p>
            <h4 class="titulo-change">Nuestras escuelas, comprometidas con la equidad de género</h4>
            <p>Desde Infantil hasta Bachillerato, las escuelas de la Red Jesuïtes Educació trabajan bajo la perspectiva de género para formar personas respetuosas con el reconocimiento de la singularidad.</p>
        </article>
        <article style="margin-bottom: 30px;" id="art-3" class="fondo_btn padding-s back-light">
            <p>FUNDACIÓN 01/03/2022</p>
            <h4 class="titulo-change">Celebramos los 500 años de la conversión de San Ignacio recorriendo su camino de Loiola a Manresa</h4>
            <p>Pero el Camino Ignaciano es mucho más: nos ponemos en ruta para hacer presentes a las personas más desfavorecidas que tenemos cerca, poniendo en valor las seis entidades que forman nuestra red de entidades sociales, gracias a las cuales damos servicio a 13.500 vecinas y vecinos de Badalona, ​​Hospitalet, Lleida y Barcelona en ámbitos esenciales como son la atención a las personas migradas (Migra Studium), a la infancia (Salut Alta y Centre Sant Jaume), a la cooperación (Entreculturas) ya las situaciones de exclusión social (Raíces San Ignacio y La Viña).</p>
        </article>
<b><hr></b>
        <section class="row padding-s">
            <h3 style="margin-bottom: 1%;" id="galeria"><b>Galería:</b></h3>
            <p style="margin-bottom: 2%; width: 100%;">Esta es una recopilación de la mejores fotografias realizadas a lo largo del curso 2020-2021 en nuestra escuela, JoanXXIII.</p>
            <div class="column-4" id="card-1"></div>
            <div class="column-4" id="card-2"></div>
            <div class="column-4" id="card-3"></div>
            <div class="column-4" id="card-4"></div>
        </section>
    </div>
</body>
</html>