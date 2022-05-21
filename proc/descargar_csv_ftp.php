<?php

require "./validar_sesion.php";
val_sesion();

include '../func/comprobar_admin.php';

if (isset($_GET['tipo_usuario'])) {
    require "conexion.php";

    $ftp = ftp_connect('192.168.13.254', '21');
    ftp_login($ftp, 'mugaty', 'ASDasd123');

    if ($_GET['tipo_usuario'] == 'alumnos') {
        
        $alu_query = "SELECT tbl_alumne.*, tbl_classe.codi_classe FROM tbl_alumne INNER JOIN tbl_classe ON tbl_alumne.classe = tbl_classe.id_classe;";
        if ($alu_request = mysqli_query($conexion, $alu_query)) {
            file_put_contents("alumnos.csv", "DNI;nombre;apellido;telf;email;classe\n");
            foreach ($alu_request as $key => $alu) {
                $line = $alu['dni_alu'].";".$alu['nom_alu'].";".$alu['cognoms_alu'].";".$alu['telf_alu'].";".$alu['email_alu'].";".$alu['codi_classe']."\n";
                file_put_contents("alumnos.csv", $line, FILE_APPEND);
            }
            
            $ret = ftp_nb_put($ftp, "./alumnos.csv", "./alumnos.csv", FTP_ASCII , FTP_AUTORESUME);

            while (FTP_MOREDATA == $ret) {
                $ret = ftp_nb_continue($ftp);
            }

            unlink("./alumnos.csv");

            die();
        }
        
    } else {
        $prof_query = "SELECT tbl_professor.*, tbl_dept.codi_dept FROM tbl_professor INNER JOIN tbl_dept ON tbl_professor.dept = tbl_dept.id_dept;";
        if ($prof_request = mysqli_query($conexion, $prof_query)) {
            file_put_contents("profesores.csv", "nombre;apellidos;email;telf;dept;admin\n");
            foreach ($prof_request as $key => $prof) {
                $line = $prof['nom_prof'].";".$prof['cognoms_prof'].";".$prof['email_prof'].";".$prof['telf'].";".$prof['dept'].";".$prof['admin']."\n";
                file_put_contents("profesores.csv", $line, FILE_APPEND);
            }

            $ret = ftp_nb_put($ftp, "./profesores.csv", './profesores.csv"', FTP_ASCII , FTP_AUTORESUME);

            while (FTP_MOREDATA == $ret) {
                $ret = ftp_nb_continue($ftp);
            }

            unlink("./profesores.csv");
            
            die();
        }
    }

} else {
    echo "<script>window.location.href = '../view/descargar_csv(temp).html'</script>";
}
