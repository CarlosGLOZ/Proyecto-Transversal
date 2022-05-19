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
            <b><a id="nombre-usuario" class="navbar-brand">Usuario:</a></b>
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
                        <a style="text-align: right;" href='../proc/destruir_sesion.php'><button class='btn btn_logout form-control ms-1' type='button'>Log out</button></a>
            </form>
        </div>
    </nav>
    
    <!-- OPCIONES -->
    <div class="crear-container">
        <button onClick="asyncShow()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true"><i class="fa-solid fa-rotate-left"></i></button>
        <button onClick="alertCreate()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true"><i class="fa-solid fa-plus"></i> Crear</button>
        <button disabled id="multiple-modify-button" onClick="alertMultipleModify()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Modificar</button>
        <button disabled id="multiple-delete-button" onClick="alertMultipleDelete()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Eliminar</button>
        <button onClick="alertUploadCSV()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Cargar CSV</button>
        <button onClick="alertDownloadCSV()" class="btn paginacion btn-lg button-style" role="button" aria-disabled="true">Descargar CSV</button>
    </div>
    <div id="filtrar-container" class="filtrar-container">
        <!-- FILTRO -->
        <input id="filtro-dni" type="text" name="dni" class="filtro form-control" placeholder="DNI"/>
        <input id="filtro-nombre" type="text" name="nombre" class="filtro form-control" placeholder="Nombre"/>
        <input id="filtro-apellidos" type="text" name="apellidos" class="filtro form-control" placeholder="Apellidos"/>
        <input id="filtro-telefono" type="text" name="telefono" class="filtro form-control" placeholder="Telefono"/>
        <input id="filtro-email" type="email" name="email" class="filtro form-control" placeholder="Email"/>
        <select id="filtro-select" class="filtro form-control" name='clases'></select>
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
        <button class="paginacion" id="start-page-button" onClick="changePage('start')"><i class="fa-solid fa-angles-left"></i></button>
        <button class="paginacion" id="reduce-page-button" onClick="changePage('reduce')"><i class="fa-solid fa-angle-left"></i></button>
        <span id="current-page">1</span>
        <button class="paginacion" id="add-page-button" onClick="changePage('add')"><i class="fa-solid fa-angle-right"></i></button>
        <button class="paginacion" id="end-page-button" onClick="changePage('end')"><i class="fa-solid fa-angles-right"></i></button>
        <span id="num-pages">12 páginas</span>
    </div>

</body>
</html>

