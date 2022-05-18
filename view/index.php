<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/index.css">
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- TIPO DE LETRA -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz@8..144&display=swap" rel="stylesheet">
    <!-- MAIN JS -->
    <script type="module" src="../js/main.js"></script>
    <title>CRUD - Alumnos</title>
</head>
<body>
    <?php

        include '../proc/validar_sesion.php';
        val_sesion();

    ?>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <b><a class="navbar-brand">Usuario:</b><?php echo $_SESSION['nom_prof'];?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
        <div class="wrap">
            <form action="" class="formulario">
                <div class="radio">
                    <input id="scope-alumnos" class="btn-check" onChange="changeDataVisualizationScope()" type="radio" value="alumnos" name="datos-scope" /> 
                    <label for="scope-alumnos">Alumnos</label>
            
                    <input id="scope-profesores" class="btn-check" onChange="changeDataVisualizationScope()" type="radio" value="profesores" name="datos-scope" />
                    <label for="scope-profesores">Profesores</label>
                </div>
            </form>
        </div>
            </div>
            <form class="d-flex">
                    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                        <a style="text-align: right;" href='../php/log_out.php'><button class='btn btn_logout form-control ms-1' type='button'>Log out</button></a>
            </form>
        </div>
    </nav>
    
    <!-- OPCIONES -->
    <div class="crear-container">
        <button onClick="asyncShow()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Recargar</button>
        <button onClick="alertCreate()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Crear</button>
        <button disabled id="multiple-modify-button" onClick="alertMultipleModify()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Modificar</button>
        <button disabled id="multiple-delete-button" onClick="alertMultipleDelete()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Eliminar</button>
        <a href="../view/cargar_csv(temp).html"><button class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Cargar CSV</button></a>
        <a href="../view/descargar_csv(temp).html"><button class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Descargar CSV</button></a>
    </div>
    <div id="filtrar-container" class="filtrar-container">
        <!-- FILTRO -->
        <input id="filtro-dni" type="text" name="dni" class="filtro form-control" placeholder="dni"/>
        <input id="filtro-nombre" type="text" name="nombre" class="filtro form-control" placeholder="nombre"/>
        <input id="filtro-apellidos" type="text" name="apellidos" class="filtro form-control" placeholder="apellidos"/>
        <input id="filtro-telefono" type="text" name="telefono" class="filtro form-control" placeholder="telefono"/>
        <input id="filtro-email" type="email" name="email" class="filtro form-control" placeholder="email"/>
        <select id="filtro-select" class="swal2-input" name='clases'></select>
        <button class="btn btn-filtros btn-lg" onClick="storeLocalFilter()">Filtrar</button>
        <button class="btn btn-filtros btn-lg" onClick="voidLocalFilter()"><i class="fa-solid fa-xmark"></i></button>
        <!-- LIMITE -->
        <input id="limite-registros" type="text" class="filtro form-control" placeholder="Limite" />
        <button class="btn btn_filtros btn-lg" onClick="changeLimit()">Limitar</button>
        <button class="btn btn-filtros btn-lg" onClick="removeLimit()"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div id="table"></div>

    <!-- PAGINACION -->
    <div class="page-buttons">
        <button class="paginacion" id="start-page-button" onClick="changePage('start')"><<</button>
        <button class="paginacion" id="reduce-page-button" onClick="changePage('reduce')"><</button>
        <span id="current-page">1</span>
        <button class="paginacion" id="add-page-button" onClick="changePage('add')">></button>
        <button class="paginacion" id="end-page-button" onClick="changePage('end')">>></button>
        <span id="num-pages">12 páginas</span>
    </div>

    
    <!-- Subida de varios archivos a la vez -->
    <!-- Calendario con eventos de la escuela -->
    <!-- Enlaces publicos para descargar deberes (FTP)  -->

</body>
</html>

