<?php

include './conexion.php';

$sql = "DELETE FROM tbl_professor WHERE id_professor={$_GET['id']}";
$listadodept = mysqli_query($conexion, $sql);

//ALTER TABLE `tbl_classe` DROP FOREIGN KEY `tbl_classe_ibfk_1`;
//ALTER TABLE `tbl_classe` ADD CONSTRAINT `tbl_classe_ibfk_1` FOREIGN KEY (`tutor`) REFERENCES `tbl_professor`(`id_professor`) ON DELETE SET NULL ON UPDATE NO ACTION;
//ALTER TABLE `tbl_classe` ADD CONSTRAINT `classe_prof_fk` FOREIGN KEY (`tutor`) REFERENCES `tbl_professor`(`id_professor`) ON DELETE RESTRICT ON UPDATE SET NULL;