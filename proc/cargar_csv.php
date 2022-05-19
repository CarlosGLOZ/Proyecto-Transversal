<?php
    // comprobar que el usuario está logeado 
    require "./validar_sesion.php";
    val_sesion();

    if (isset($_FILES['csv']) && isset($_POST['tipo_usuario'])) {

        $errorThrown = false;
        $csvFileName = "csv_upload.csv";
        move_uploaded_file($_FILES['csv']['tmp_name'], $csvFileName);
        $lineas = file($csvFileName);
        $cont=0;
        $cont_repetidos = 0;

        if ($_POST['tipo_usuario'] == 'alumnos') {
            require "./conexion.php";
            $alu_check_query="SELECT email_alu FROM tbl_alumne";
            $alu_check_request = mysqli_query($conexion,$alu_check_query);
            $tipoUsuario = 'ALUMNO';

            $lista_emails = [];
            
            foreach ($alu_check_request as $key => $alu) {
                array_push($lista_emails, $alu['email_alu']);
            }

            foreach ($lineas as $alumno) {
                $campos = explode(";", $alumno);
                if ($cont==0) {
                    $cont++;
                    continue;
    
                } else if (!in_array($campos[4], $lista_emails)) { // SI EL CORREO NO ESTÁ EN LA BDD.
                    $cont++;
                    $datos= "'{$campos[0]}', '{$campos[1]}' , '{$campos[2]}', '{$campos[3]}', '{$campos[4]}', {$campos[5]}";
        
                    $insert_alu_query ="INSERT INTO `tbl_alumne`(`dni_alu`, `nom_alu`, `cognoms_alu`, `telf_alu`, `email_alu`, `classe`) VALUES ($datos);";
                    
                    try {
                        $insert_alu_request = mysqli_query($conexion,$insert_alu_query);
                    } catch (\Throwable $th) {
                        $errorThrown = true;
                    }

                } else { // SI EL CORREO ESTÁ EN LA BDD.
                    $cont_repetidos++;
                }
            }            
        } else {
            require "./conexion.php";
            $prof_check_query="SELECT email_prof FROM tbl_professor";
            $prof_check_request = mysqli_query($conexion,$prof_check_query);
            $tipoUsuario = 'PROFESOR';

            $lista_emails = [];
            
            foreach ($prof_check_request as $key => $prof) {
                array_push($lista_emails, $prof['email_prof']);
            }


            
            foreach ($lineas as $profesor) {
                $campos = explode(";", $profesor);
                if ($cont==0) {
                    $cont++;
                    continue;
    
                } else if (!in_array($campos[2],$lista_emails)) { // SI EL CORREO NO ESTÁ EN LA BDD.
                    $cont++;
                    $datos= "'{$campos[0]}', '{$campos[1]}' , '{$campos[2]}', '{$campos[3]}', {$campos[4]}, '".sha1($campos[5])."', {$campos[6]}";
        
                    $insert_prof_query ="INSERT INTO `tbl_professor`(`nom_prof`, `cognoms_prof`, `email_prof`, `telf`, `dept`, `contra`, `admin` ) VALUES ($datos);";
                    
                    try {
                        $insert_prof_request = mysqli_query($conexion,$insert_prof_query);
                    } catch (\Throwable $th) {
                        $errorThrown = true;
                    }
                } else { // SI EL CORREO ESTÁ EN LA BDD.
                    $cont_repetidos++;
                }
            }
        }
        if (!$errorThrown) {
            unlink("csv_upload.csv");
            unlink($csvFileName);
            if ($cont > 1) {
                echo "<script>alert('SE HAN INSERTADO ".($cont-1)." USUARIOS COMO [{$tipoUsuario}]');</script>";
            }
            if ($cont_repetidos > 0) {
                echo "<script>alert('SE HAN OMITIDO ".($cont_repetidos)." REGISTORS REPETIDOS');</script>";
            }
            echo "<script>window.location.href = '../view/index.php'</script>";
            die();
        } else {
            echo "<script>alert('HA HABIDO UN ERROR INSERTANDO ALGUNOS REGISTROS. ES POSIBLE QUE SE HAYA SELECCIONADO EL CAMPO INCORRECTO O ALGUNA ENTRADA YA EXISTA CON ESOS DATOS.');</script>";

        }
    } else {
        echo "<script>window.location.href = '../view/cargar_csv(temp).html'</script>";
    }