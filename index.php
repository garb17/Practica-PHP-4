<?php

    session_start();

    if(isset($_POST['btnContinuar'])&& $_POST['btnContinuar'] == 'Continuar'){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['sucursal']=$_REQUEST['selectSucursal'];
            header('Location: login.php');
        }
    }

    include_once("assets/php/conexion.php");
    $query = "SELECT sede, sucursal FROM emb_sede ORDER BY sede ASC";
    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); 

?>

<!DOCTYPE html>
<html lang="es" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica-PHP-4</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <section class="contenedor-vertical">

        <div class="contenedor-horizontal card-principal">
            <h1 class="text-center display-4 separacion-grande-bottom">BIENVENIDO</h1>
            <div class="contenedor-horizontal">
                <p>Bienvenido a la página dministrativa de la Embotelladora Thomsom. Antes de continuar, ingresa en que sede se esta realizando la gestion: </p>
                <form action="" method="post">
                    <div class="form-floating">
                        <select class="form-select" id="selectSucursal" name='selectSucursal'aria-label="Floating label select example">
                            <?php while($fila = mysqli_fetch_array($rs)){  ?>
                                <option value="<?php echo $fila['sucursal'];  ?>"><?php echo $fila['sede']." - ". $fila['sucursal']; ?></option>
                            <?php }?>
                        </select>
                        <label for="floatingSelect">Elige la sede de la Embotelladora Thomsom</label>
                    </div>
                    <div class="centrar-boton">
                        <button type="submit" class="btn btn-primary btn-lg" value="Continuar" name="btnContinuar">Continuar</button>
                    </div>
                </form>
            </div>
        </div>    

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>