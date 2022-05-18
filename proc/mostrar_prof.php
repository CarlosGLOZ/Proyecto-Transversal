<?php

include '../proc/validar_sesion.php';
val_sesion();

include './conexion.php';

if (!isset($_GET['nombre']) && !isset($_GET['apellidos']) && !isset($_GET['telefono']) && !isset($_GET['email']) && !isset($_GET['dept'])) {
    /* MOSTRAR TODO LOS REGISTROS SIN FILTROS */
    $sql = "SELECT tbl_professor.id_professor, tbl_professor.nom_prof, tbl_professor.cognoms_prof, tbl_professor.email_prof, tbl_professor.telf, tbl_dept.id_dept, tbl_dept.nom_dept, tbl_classe.codi_classe 
            FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept 
            LEFT JOIN tbl_classe ON tbl_classe.tutor = tbl_professor.id_professor";

    $sql_total = "SELECT COUNT(1) as `total` FROM tbl_professor";

} else {
    /* MOSTRAR LOS REGISTROS CON FILTROS */
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $telefono = $_GET['telefono'];
    $email = $_GET['email'];
    $dept = $_GET['dept'];
    $sql = "SELECT tbl_professor.id_professor, tbl_professor.nom_prof, tbl_professor.cognoms_prof, tbl_professor.email_prof, tbl_professor.telf, tbl_dept.id_dept, tbl_dept.nom_dept, tbl_classe.codi_classe 
            FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept 
            LEFT JOIN tbl_classe ON tbl_classe.tutor = tbl_professor.id_professor
            WHERE `nom_prof` LIKE '%$nombre%' AND `cognoms_prof` LIKE '%$apellidos%' AND `telf` LIKE '%$telefono%' AND `email_prof` LIKE '%$email%' AND `dept` LIKE '%$dept%'";

    $sql_total = "SELECT count(1) as `total`
                  FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept 
                  LEFT JOIN tbl_classe ON tbl_classe.tutor = tbl_professor.id_professor 
                  WHERE `nom_prof` LIKE '%$nombre%' AND `cognoms_prof` LIKE '%$apellidos%' AND `telf` LIKE '%$telefono%' AND `email_prof` LIKE '%$email%' AND `dept` LIKE '%$dept%'";
}


if (isset($_GET['orderby'])) {
    /* ORDENAR REGISTROS POR CAMPO */
    $orderby = $_GET['orderby'];
    if ($orderby == 'nombre') {
        $sql .= " ORDER BY nom_prof";
    } else if ($orderby == 'apellidos') {
        $sql .= " ORDER BY cognoms_prof";
    } else if ($orderby == 'telefono') {
        $sql .= " ORDER BY telf";
    } else if ($orderby == 'email') {
        $sql .= " ORDER BY email_prof";
    } else if ($orderby == 'dept') {
        $sql .= " ORDER BY id_dept";
    }
} else {
    $sql .= " ORDER BY id_professor DESC";
}

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

$profesores = mysqli_query($conexion, $sql);


/* MOSTRAR LOS DATOS */
?>

<b class="text-center">Resultados: <?php echo $total ?></b>
<table>
<tr>
<th class="header-check"><input id="check-all" onClick="checkAllCheckboxes()" type="checkbox"/></th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'nombre' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('nombre')">Nombre</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'apellidos' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('apellidos')">Apellidos</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'telefono' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('telefono')">Teléfono</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'email' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('email')">Email</th>
<th class="headers-orderby <?php echo isset($orderby) && $orderby == 'dept' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('dept')">Departamento</th>
<th>Clase</th>
<th>Accion</th>
</tr>

<?php
foreach ($profesores as $profesor) {
    ?>
    <tr>
        <td><input onClick="checkCheckedCheckboxes()" type="checkbox" name='profesor' value="<?php echo $profesor['id_professor']; ?>"/></td>
        <td><?php echo $profesor['nom_prof']; ?></td>
        <td><?php echo $profesor['cognoms_prof']; ?></td>
        <td><?php echo $profesor['telf']; ?></td>
        <td><?php echo $profesor['email_prof']; ?></td>
        <td><?php echo $profesor['nom_dept']; ?></td>
        <td><?php echo !empty($profesor['codi_classe']) ? $profesor['codi_classe'] : '---'; ?></td>
        <td>
            <button class="btn btn-danger" onClick="alertDelete(<?php echo $profesor['id_professor']; ?>)"><i class="fa-solid fa-trash-can"></i></button>
            <button class="btn btn-primary" onClick="alertModifyProf(<?php echo $profesor['id_professor']; ?>, '<?php echo $profesor['nom_prof']; ?>', '<?php echo $profesor['cognoms_prof']; ?>', '<?php echo $profesor['telf']; ?>', '<?php echo $profesor['email_prof']; ?>', <?php echo $profesor['id_dept']; ?>)"><i class="fa-solid fa-pen-to-square"></i></button>
            <button class="btn btn-secondary" onClick="alertChangePasswordProf(<?php echo $profesor['id_professor']; ?>)"><i class="fa-solid fa-key"></i></button>
        </td>
    </tr>
    <?php
}

echo '</table>';
echo "<input id='max-pages' type='hidden' value='$maxPag' />";

