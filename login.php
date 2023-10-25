<?php
    session_start();
    include_once("assets/php/conexion.php");

    if(!isset($_SESSION['sucursal'])){
        session_destroy();
        header("Location: index.php");    
    }
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
<body id="login">

    <section class="contenedor-vertical">

        <div class="contenedor-horizontal card-principal">
            <h1 class="text-center display-4 separacion-corta-bottom">INICIAR SESIÓN</h1>
            <div class="centrar-boton">
                <img id="img-login" src="assets/img/user.png" class="separacion-corta-bottom" alt="" width=150px><br><br>
            </div>
            <div class="contenedor-horizontal">
                <div class="contenedor-horizontal">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="idCorreo"  placeholder="name@example.com" required>
                        <label for="idCorreo">Correo electrónico</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="idContrasena" placeholder="Password" required>
                        <label for="idContrasena">Contraseña</label>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 centrar-boton">
                            <p><a class="espaciado" href="" style="color:black">He olvidado la contraseña</a></p>
                        </div>
                        <div class="col-md-6 col-sm-12 centrar-boton">
                            <button type="button" onclick="iniciarSesion()" class="btn btn-primary btn-lg">Ingresar</button>
                        </div>
                    </div>
                </form>
                </div>
            </div><h5 class="text-center" style="color:red" id="result"></h5>
        </div>    
        
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>