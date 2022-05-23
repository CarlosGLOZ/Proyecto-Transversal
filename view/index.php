<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- TIPO DE LETRA -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz@8..144&display=swap" rel="stylesheet">
    <!-- MAIN JS -->
    <script type="module" src="../js/main.js"></script>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/index.css">
    <title>Gestión Jesuites Educació</title>
</head>
<body>
    <?php

        include '../proc/validar_sesion.php';
        val_sesion();

        $admin = $_SESSION['admin'];
    
    ?>

    <div class="crud-content">
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img src="../img/imagen.png" class="me-2" height="35" alt="JE Logo" />
                <b><a id="nombre-usuario" class="navbar-brand">Bienvenido, </a></b>
                <div class="nav-buttons">
                    <a><button class='btn_settings form-control animated-button' type='button'><i class="fa-solid fa-gear fa-lg"></i></button></a>
                    <a href='../proc/destruir_sesion.php'><button class='btn btn_logout form-control animated-button' type='button'><i class="fa-solid fa-right-from-bracket fa-lg"></i></button></a>
                </div>
            </div>
        </nav>
        <!-- OPCIONES -->
        <div class="opciones-crud-container">
            <button onClick="asyncShow()" class="btn-style button-style animated-button" role="button" aria-disabled="true"><i class="fa-solid fa-rotate-left"></i></button>
            <?php
                if ($admin) {
                    echo '<button onClick="alertCreate()" class=" btn-style button-style animated-button" role="button" aria-disabled="true"><i class="fa-solid fa-plus"></i> Crear</button>';
                    echo '<button disabled id="multiple-modify-button" onClick="alertMultipleModify()" class=" btn-style button-style animated-button" role="button" aria-disabled="true">Modificar</button>';
                    echo '<button disabled id="multiple-delete-button" onClick="alertMultipleDelete()" class=" btn-style button-style animated-button" role="button" aria-disabled="true">Eliminar</button>';
                }
            ?>
            
            <!-- FILTRO -->
            <div id="filtrar-container" class="dropdown filtrar-container">
                <input id="display-filtro" type="checkbox" />
                <label class="btn-style animated-button" for="display-filtro">Filtro</label>
                <div class="dropdown-content">
                    <div id="filtros-container" class="filtros-container">
                        <input id="filtro-dni" type="text" name="dni" class="filtro form-control" placeholder="DNI"/>
                        <input id="filtro-nombre" type="text" name="nombre" class="filtro form-control" placeholder="Nombre"/>
                        <input id="filtro-apellidos" type="text" name="apellidos" class="filtro form-control" placeholder="Apellidos"/>
                        <input id="filtro-telefono" type="text" name="telefono" class="filtro form-control" placeholder="Telefono"/>
                        <input id="filtro-email" type="email" name="email" class="filtro form-control" placeholder="Email"/>
                        <select id="filtro-select" class="filtro form-control" name='clases'></select>
                        <button class="btn btn-filtros btn-lg" onClick="storeLocalFilter()">Filtrar</button>
                        <button class="btn btn-filtros btn-lg" onClick="voidLocalFilter()"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="filtros-container">
                        <!-- LIMITE -->
                        <input id="limite-registros" type="text" class="filtro form-control" placeholder="Limite" />
                        <button class="btn btn-filtros btn-lg" onClick="changeLimit()">Limitar</button>
                        <button class="btn btn-filtros btn-lg" onClick="removeLimit()"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            </div>
            <!-- CARGAR / DESCARGAR CSV -->
            <?php
                if ($admin) {
                    ?>
                        <button onClick="alertUploadCSV()" class="btn-style button-style animated-button" role="button" aria-disabled="true"><i class="fa-solid fa-file-arrow-up"></i> Cargar CSV</button>   
                        <div class="dropdown">
                            <button class="btn-style button-style dropdown-toggle animated-button" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-floppy-disk"></i> Descargar CSV
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" onClick="alertDownloadCSV('local')" role="button" aria-disabled="true">Descargar en local</button>
                                <button class="dropdown-item" onClick="alertDownloadCSV('servidor')" type="button">Descargar en servidor</button>
                            </div>
                        </div>
                        <button id="multiple-mail-button" onClick="alertMultipleMail()" class=" btn-style button-style animated-button" role="button" aria-disabled="true"><i class="fa-solid fa-envelope"></i> Correo</button>
                    <?php
                }
            ?>
            
            <div class="wrapper">
                <input id="scope-alumnos" class="btn-check" onChange="changeDataVisualizationScope()" type="radio" value="alumnos" name="datos-scope" /> 
                <input id="scope-profesores" class="btn-check" onChange="changeDataVisualizationScope()" type="radio" value="profesores" name="datos-scope" />
                <label class="option option-1 btn-style animated-button" for="scope-alumnos"><div class="dot"></div><span>Alumnos</span></label>
                <label class="option option-2 btn-style animated-button" for="scope-profesores"><div class="dot"></div><span>Profesores</span></label>
            </div>
        </div>
    
        
        <div class="table-container">
            <div id="table"></div>
        </div>
    
        <!-- PAGINACION -->
        <div class="page-buttons">
            <button class="paginacion" id="start-page-button" onClick="changePage('start')"><i class="fa-solid fa-angles-left"></i></button>
            <button class="paginacion" id="reduce-page-button" onClick="changePage('reduce')"><i class="fa-solid fa-angle-left"></i></button>
            <span id="current-page">1</span>
            <button class="paginacion" id="add-page-button" onClick="changePage('add')"><i class="fa-solid fa-angle-right"></i></button>
            <button class="paginacion" id="end-page-button" onClick="changePage('end')"><i class="fa-solid fa-angles-right"></i></button>
            <span id="num-pages">12 páginas</span>
        </div>
    </div>

</body>
</html>

