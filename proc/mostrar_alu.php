<?php

include './conexion.php';

if (!isset($_GET['nombre']) && !isset($_GET['dni']) && !isset($_GET['apellidos']) && !isset($_GET['telefono']) && !isset($_GET['email']) && !isset($_GET['clase'])) {
    /* MOSTRAR TODO LOS REGISTROS SIN FILTROS */
    $sql = "SELECT * FROM tbl_alumne INNER JOIN tbl_classe ON tbl_alumne.classe = tbl_classe.id_classe";
    $sql_total = "SELECT count(1) as 'total' FROM tbl_alumne";
    
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
    $sql .= " ORDER BY id_alumne";
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
?>

<b class="text-center">Resultados: <?php echo $total ?></b>
<table>
<tr>
<th class="header-check"><input id="check-all" onClick="checkAllCheckboxes()" type="checkbox"/></th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'dni' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('dni')" >DNI</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'nombre' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('nombre')">Nombre</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'apellidos' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('apellidos')">Apellidos</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'telefono' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('telefono')">Teléfono</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'email' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('email')">Email</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'clase' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('clase')">Clase</th>
<th>Accion</th>
</tr>

<?php
foreach ($alumnos as $alumno) {
    ?>
    <tr>
        <td><input onClick="checkCheckedCheckboxes()" type="checkbox" name='alumno' value="<?php echo $alumno['id_alumne']; ?>"/></td>
        <td><?php echo $alumno['dni_alu']; ?></td>
        <td><?php echo $alumno['nom_alu']; ?></td>
        <td><?php echo $alumno['cognoms_alu']; ?></td>
        <td><?php echo $alumno['telf_alu']; ?></td>
        <td><?php echo $alumno['email_alu']; ?></td>
        <td><?php echo $alumno['codi_classe']; ?></td>
        <td>
            <button class="btn btn-danger" onClick="alertDelete(<?php echo $alumno['id_alumne']; ?>)"><i class="fa-solid fa-trash-can"></i></button>
            <button class="btn btn-primary" onClick="alertModify(<?php echo $alumno['id_alumne']; ?>, '<?php echo $alumno['dni_alu']; ?>', '<?php echo $alumno['nom_alu']; ?>', '<?php echo $alumno['cognoms_alu']; ?>', '<?php echo $alumno['telf_alu']; ?>', '<?php echo $alumno['email_alu']; ?>', <?php echo $alumno['id_classe']; ?>)"><i class="fa-solid fa-pen-to-square"></i></button>
        </td>
    </tr>
    <?php
}

echo '</table>';
echo "<input id='max-pages' type='hidden' value='$maxPag' />";

