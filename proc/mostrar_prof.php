<?php

include '../proc/validar_sesion.php';
val_sesion();

$admin = $_SESSION['admin'];

include './conexion.php';

if (!isset($_GET['nombre']) && !isset($_GET['apellidos']) && !isset($_GET['telefono']) && !isset($_GET['email']) && !isset($_GET['dept'])) {
    /* MOSTRAR TODO LOS REGISTROS SIN FILTROS */
    $sql = "SELECT tbl_professor.id_professor, tbl_professor.nom_prof, tbl_professor.cognoms_prof, tbl_professor.email_prof, tbl_professor.telf, tbl_professor.admin, tbl_dept.id_dept, tbl_dept.nom_dept, tbl_classe.codi_classe, tbl_classe.id_classe
            FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept 
            LEFT JOIN tbl_classe ON tbl_classe.tutor = tbl_professor.id_professor";

    $sql_total = "SELECT COUNT(1) as `total` FROM tbl_professor";
    $filtrado = false;

} else {
    /* MOSTRAR LOS REGISTROS CON FILTROS */
    $nombre = $_GET['nombre'];
    $apellidos = $_GET['apellidos'];
    $telefono = $_GET['telefono'];
    $email = $_GET['email'];
    $dept = $_GET['dept'];
    $sql = "SELECT tbl_professor.id_professor, tbl_professor.nom_prof, tbl_professor.cognoms_prof, tbl_professor.email_prof, tbl_professor.telf, tbl_professor.admin, tbl_dept.id_dept, tbl_dept.nom_dept, tbl_classe.codi_classe, tbl_classe.id_classe
            FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept 
            LEFT JOIN tbl_classe ON tbl_classe.tutor = tbl_professor.id_professor
            WHERE `nom_prof` LIKE '%$nombre%' AND `cognoms_prof` LIKE '%$apellidos%' AND `telf` LIKE '%$telefono%' AND `email_prof` LIKE '%$email%' AND `dept` LIKE '%$dept%'";

    $sql_total = "SELECT count(1) as `total`
                  FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept 
                  LEFT JOIN tbl_classe ON tbl_classe.tutor = tbl_professor.id_professor 
                  WHERE `nom_prof` LIKE '%$nombre%' AND `cognoms_prof` LIKE '%$apellidos%' AND `telf` LIKE '%$telefono%' AND `email_prof` LIKE '%$email%' AND `dept` LIKE '%$dept%'";

    $filtrado = true;
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
if (!$filtrado) {
    echo "<b  style='color: rgb(142, 202, 230); margin-bottom: 10px' class='text-center'>$total registros</b>";
} else {
    echo "<b  style='color: rgb(142, 202, 230); margin-bottom: 10px' class='text-center'>$total registros coinciden con los criterios de busqueda</b>";
}

?>
<table id="table-prof" class="table">
<tr>
<th class="header-check">
    <label class="checkbox bounce">
        <input id="check-all" onClick="checkAllCheckboxes()" type="checkbox"/>
        <svg viewBox="0 0 21 21">
            <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
        </svg>
    </label>
</th>
<th class="header-nombre headers-orderby <?php echo isset($orderby) && $orderby == 'nombre' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('nombre')">Nombre</th>
<th class="header-apellidos headers-orderby <?php echo isset($orderby) && $orderby == 'apellidos' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('apellidos')">Apellidos</th>
<th class="header-telefono headers-orderby <?php echo isset($orderby) && $orderby == 'telefono' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('telefono')">Teléfono</th>
<th class="header-correo headers-orderby <?php echo isset($orderby) && $orderby == 'email' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('email')">Email</th>
<th class="header-dept headers-orderby <?php echo isset($orderby) && $orderby == 'dept' ? 'headers-orderby-checked' : '' ?>" onClick="changeOrderBy('dept')">Departamento</th>
<th class="header-tutor">Tutor</th>

<?php
if ($admin) {
    echo "<th class='header-admin'>Admin</th>";
    echo "<th>Acción</th>";
}
?>

</tr>

<?php
foreach ($profesores as $profesor) {
    ?>
    <tr>
        <td >
            <label class="checkbox bounce">
                <input onClick="checkCheckedCheckboxes()" type="checkbox" name='profesor' value="<?php echo $profesor['id_professor']; ?>"/>
                <svg viewBox="0 0 21 21">
                    <polyline points="5 10.75 8.5 14.25 16 6"></polyline>
                </svg>
            </label>
        </td>
        <td class="column-nombre"><?php echo $profesor['nom_prof']; ?></td>
        <td><?php echo $profesor['cognoms_prof']; ?></td>
        <td class="column-telefono"><?php echo $profesor['telf']; ?></td>
        <td class="column-correo"><?php echo $profesor['email_prof']; ?></td>
        <td><?php echo $profesor['nom_dept']; ?></td>
        <td><?php echo !empty($profesor['codi_classe']) ? $profesor['codi_classe'] : '<i class="fa-solid fa-minus fa-lg"></i>'; ?></td>
        <?php
            if ($admin) {
                ?>
                <td class="column-admin"><?php echo $profesor['admin'] ? '<i class="fa-solid fa-check fa-lg"></i>' : '<i class="fa-solid fa-xmark fa-lg"></i>' ?></td>
                <td class="column-accion">
                    <div class="dropdown">
                        <button class="display-options" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical fa-lg"></i>
                        </button>
                        <div class="dropdown-menu options" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item eliminar" onClick="alertDelete(<?php echo $profesor['id_professor']; ?>)"><i class="fa-solid fa-trash-can"></i> Eliminar</button>
                            <button class="dropdown-item modificar" onClick="alertModifyProf(<?php echo $profesor['id_professor']; ?>, '<?php echo $profesor['nom_prof']; ?>', '<?php echo $profesor['cognoms_prof']; ?>', '<?php echo $profesor['telf']; ?>', '<?php echo $profesor['email_prof']; ?>', <?php echo $profesor['id_dept']; ?>, <?php echo $profesor['id_classe'] ? $profesor['id_classe'] : "'none'"; ?>, <?php echo $profesor['admin']; ?>)"><i class="fa-solid fa-pen-to-square"></i> Modificar</button>
                            <button class="dropdown-item password" onClick="alertChangePasswordProf(<?php echo $profesor['id_professor']; ?>)"><i class="fa-solid fa-key"></i> Password</button>
                            <button class="dropdown-item correo" onClick="alertSendMail('<?php echo $profesor['email_prof']; ?>')"><i class="fa-solid fa-envelope"></i> Correo</button>
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

