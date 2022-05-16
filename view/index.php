<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- MAIN JS -->
    <script type="module" src="../js/main.js"></script>
    <title>CRUD - Alumnos</title>
</head>
<body>

    <!-- OPCIONES -->
    <div class="crear-container">
        <button onClick="asyncShow()" class="btn btn-success btn-lg button-style" role="button" aria-disabled="true">Recargar</button>
        <button onClick="alertCreate()" class="btn btn-success btn-lg button-style" role="button" aria-disabled="true">Crear</button>
        <button disabled id="multiple-modify-button" onClick="alertMultipleModify()" class="btn btn-success btn-lg button-style" role="button" aria-disabled="true">Modificar</button>
        <button disabled id="multiple-delete-button" onClick="alertMultipleDelete()" class="btn btn-success btn-lg button-style" role="button" aria-disabled="true">Eliminar</button>
    </div>
    <div class="filtrar-container">
        <!-- FILTRO -->
        <input id="filtro-dni" type="text" name="dni" class="form-control" placeholder="dni"/>
        <input id="filtro-nombre" type="text" name="nombre" class="form-control" placeholder="nombre"/>
        <input id="filtro-apellidos" type="text" name="apellidos" class="form-control" placeholder="apellidos"/>
        <input id="filtro-telefono" type="text" name="telefono" class="form-control" placeholder="telefono"/>
        <input id="filtro-email" type="email" name="email" class="form-control" placeholder="email"/>
        <select id="filtro-clases" class="swal2-input" name='clases'></select>
        <button class="btn btn-info btn-lg" onClick="storeLocalFilter()">Filtrar</button>
        <button class="btn btn-info btn-lg" onClick="voidLocalFilter()"><i class="fa-solid fa-xmark"></i></button>
        <!-- LIMITE -->
        <input id="limite-registros" type="text" class="form-control" placeholder="Limite" />
        <button class="btn btn-info btn-lg" onClick="changeLimit()">Limitar</button>
        <button class="btn btn-info btn-lg" onClick="removeLimit()"><i class="fa-solid fa-xmark"></i></button>
    </div>

    <div id="table"></div>

    <!-- PAGINACION -->
    <div class="page-buttons">
        <button id="start-page-button" onClick="changePage('start')"><<</button>
        <button id="reduce-page-button" onClick="changePage('reduce')"><</button>
        <span id="current-page">1</span>
        <button id="add-page-button" onClick="changePage('add')">></button>
        <button id="end-page-button" onClick="changePage('end')">>></button>
        <span id="num-pages">12 páginas</span>
    </div>

    
    <!-- Subida de varios archivos a la vez -->
    <!-- Calendario con eventos de la escuela -->
    <!-- Enlaces publicos para descargar deberes (FTP)  -->

</body>
</html>

