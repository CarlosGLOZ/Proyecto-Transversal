<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <?php
        error_reporting(E_ALL ^ E_WARNING); 
        // comprobar que el usuario está logeado 
        require "../proc/validar_sesion.php";
        val_sesion();

        // conexion a BDD
        require "../proc/conexion.php";

        if (!isset($_GET['usuarios'])) {
            echo "<script>window.location.href = '?usuarios=alumno'</script>";
        } else {
            $usuarios_query = "SELECT * FROM tbl_alumne WHERE nom_alu LIKE '%".$_GET['filtro-nombre']."%' AND email_alu LIKE '%".$_GET['filtro-correo']."%' AND cognoms_alu LIKE '%".$_GET['filtro-apellidos']."%' AND telf_alu LIKE '%".$_GET['filtro-telefono']."%' AND classe LIKE '%%';";
            // echo "QUERY: ".$usuarios_query."<br>";
            $result = mysqli_query($conexion, $usuarios_query);
            $result_assoc = mysqli_fetch_assoc($result);
            foreach ($result_assoc as $key => $value) {
                echo $key." -> ".$value."<br>";
            }
        }
    ?>
</body>
</html>