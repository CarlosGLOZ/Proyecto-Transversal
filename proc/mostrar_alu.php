<?php

include '../proc/validar_sesion.php';
val_sesion();

$admin = $_SESSION['admin'];

include './conexion.php';

if (!isset($_GET['nombre']) && !isset($_GET['dni']) && !isset($_GET['apellidos']) && !isset($_GET['telefono']) && !isset($_GET['email']) && !isset($_GET['clase'])) {
    /* MOSTRAR TODO LOS REGISTROS SIN FILTROS */
    $sql = "SELECT * FROM tbl_alumne INNER JOIN tbl_classe ON tbl_alumne.classe = tbl_classe.id_classe";
    $sql_total = "SELECT count(1) as 'total' FROM tbl_alumne";
    $filtrado = false;
    
} else {
    /* MOSTRAR LOS REGISTROS CON FILTROS */
    $dni = $_GET['dni'];
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $telefono = $_GET['telefono'];
    $email = $_GET['email'];
    $clase = $_GET['clase'];
    $sql = "SELECT * FROM tbl_alumne INNER JOIN tbl_classe ON tbl_alumne.classe = tbl_classe.id_classe WHERE `dni_alu` LIKE '%$dni%' AND `nom_alu` LIKE '%$nombre%' AND `cognoms_alu` LIKE '%$apellidos%' AND `telf_alu` LIKE '%$telefono%' AND `email_alu` LIKE '%$email%' AND `classe` LIKE '%$clase%'";
    $sql_total = "SELECT count(1) as 'total' FROM tbl_alumne INNER JOIN tbl_classe ON tbl_alumne.classe = tbl_classe.id_classe WHERE `dni_alu` LIKE '%$dni%' AND `nom_alu` LIKE '%$nombre%' AND `cognoms_alu` LIKE '%$apellidos%' AND `telf_alu` LIKE '%$telefono%' AND `email_alu` LIKE '%$email%' AND `classe` LIKE '%$clase%'";
    $filtrado = true;
}

if (isset($_GET['orderby'])) {
    /* ORDENAR REGISTROS POR CAMPO */
    $orderby = $_GET['orderby'];
    if ($orderby == 'nombre') {
        $sql .= " ORDER BY nom_alu";
    } else if ($orderby == 'dni') {
        $sql .= " ORDER BY dni_alu";
    } else if ($orderby == 'apellidos') {
        $sql .= " ORDER BY cognoms_alu";
    } else if ($orderby == 'telefono') {
        $sql .= " ORDER BY telf_alu";
    } else if ($orderby == 'email') {
        $sql .= " ORDER BY email_alu";
    } else if ($orderby == 'clase') {
        $sql .= " ORDER BY classe";
    }
} else {
    $sql .= " ORDER BY id_alumne DESC";
}

/* CALCULAR NUMERO DE PÁGINAS */
$total = mysqli_query($conexion, $sql_total);
$total = mysqli_fetch_assoc($total)['total'];

/* CALCULAR CANTIDAD DE REGISTROS POR PÁGINA */
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    if ($limit != 'none' && $limit > 0) {
        $cantidad = $limit;
    } else {
        $cantidad = $total;
    }
} else {
    $cantidad = $total;
}

//CALCULAR MAXIMO DE PAGINAS
if ($total > 0) {
    $maxPag = ceil($total/$cantidad);
} else {
    $maxPag = 1;
}

/* LIMITAR REGISTROS POR PÁGINA */
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page > 0) {
        $inicioPagina = ($page-1)*$cantidad;
        $sql .= " LIMIT $inicioPagina, $cantidad";
    }
} else {
    $sql .= " LIMIT 1, 9";
}

$alumnos = mysqli_query($conexion, $sql);


/* MOSTRAR LOS DATOS */
if (!$filtrado) {
    echo "<b  style='color: rgb(142, 202, 230); margin-bottom: 10px' class='text-center'>$total registros</b>";
} else {
    echo "<b  style='color: rgb(142, 202, 230); margin-bottom: 10px' class='text-center'>$total registros coinciden con los criterios de busqueda</b>";
}

?>
<table class="table">
<tr>
<th scope="col" class="header-check"><input id="check-all" onClick="checkAllCheckboxes()" type="checkbox"/></th>
<th scope="col" class="headers-orderby <?php echo isset($orderby) && $orderby == 'dni' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('dni')" >DNI</th>
<th scope="col" class="headers-orderby <?php echo isset($orderby) && $orderby == 'nombre' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('nombre')">Nombre</th>
<th scope="col" class="headers-orderby <?php echo isset($orderby) && $orderby == 'apellidos' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('apellidos')">Apellidos</th>
<th scope="col" class="headers-orderby <?php echo isset($orderby) && $orderby == 'telefono' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('telefono')">Teléfono</th>
<th scope="col" class="headers-orderby <?php echo isset($orderby) && $orderby == 'email' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('email')">Email</th>
<th scope="col" class="headers-orderby <?php echo isset($orderby) && $orderby == 'clase' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('clase')">Clase</th>

<?php
if ($admin) {
    echo "<th scope='col'>Acción</th>";
}
?>

</tr>

<?php
foreach ($alumnos as $alumno) {
    ?>
    <tr>
        <td scope="row"><input onClick="checkCheckedCheckboxes()" type="checkbox" name='alumno' value="<?php echo $alumno['id_alumne']; ?>"/></td>
        <td><?php echo $alumno['dni_alu']; ?></td>
        <td><?php echo $alumno['nom_alu']; ?></td>
        <td><?php echo $alumno['cognoms_alu']; ?></td>
        <td><?php echo $alumno['telf_alu']; ?></td>
        <td><?php echo $alumno['email_alu']; ?></td>
        <td><?php echo $alumno['codi_classe']; ?></td>

        <?php
            if ($admin) {
                ?>
                <td>
                    <div class="dropdown">
                        <button class="display-options" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <div class="dropdown-menu options" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item eliminar" onClick="alertDelete(<?php echo $alumno['id_alumne']; ?>)"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                            <button class="dropdown-item modificar" onClick="alertModifyAlu(<?php echo $alumno['id_alumne']; ?>, '<?php echo $alumno['dni_alu']; ?>', '<?php echo $alumno['nom_alu']; ?>', '<?php echo $alumno['cognoms_alu']; ?>', '<?php echo $alumno['telf_alu']; ?>', '<?php echo $alumno['email_alu']; ?>', <?php echo $alumno['id_classe']; ?>)"><i class="fa-solid fa-pen-to-square"></i> Modificar</button>
                            <button class="dropdown-item correo" onClick="alertSendMail('<?php echo $alumno['email_alu']; ?>')"><i class="fa-solid fa-envelope"></i> Correo</button>
                        </div>
                    </div>
                </td>
                <?php
            }
        ?>
        
    </tr>
    <?php
}

echo '</table>';
echo "<input id='max-pages' type='hidden' value='$maxPag' />";

