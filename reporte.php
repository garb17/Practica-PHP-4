<?php

    session_start();
    include_once("assets/php/conexion.php");

    $query = "SELECT sede, sucursal FROM emb_sede ORDER BY sede ASC";
    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); 

    if(!isset($_SESSION['sucursal'])&&isset($_SESSION['id_usuario'])){
        session_destroy();
        header("Location: index.php");
    }

    if(isset($_POST['btnCambSede'])&&$_POST['btnCambSede']=="Cambiar"){
        $_SESSION['sucursal']=$_REQUEST['selectSucursal'];
    }

    
?>

<!DOCTYPE html>
<html lang="es" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica-PHP-4</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/fdb097e44b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body onload="selectReporte()">

    <section class="contenedor-vertical">
        <div class="contenedor-horizontal card-principal">
            
            <div class="contenido" >
                <a href="menu.php" ><i class="fa-solid fa-arrow-right fa-rotate-180 fa-lg" style="color:white"></i></a>
                <div class="dropdown alinear-derecha">
                    <button id="ajustes" class="btn btn-secondary " style="background-color:#9dc4ed; border-color:#9dc4ed" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                        <i class="fa-solid fa-gear fa-lg" style="color:#246db3"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Perfil</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Sede</a></li>
                        <li><a class="dropdown-item" href="cerrar-sesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>    
            </div>

            <br><br>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar sede</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-floating">
                                    <select class="form-select" id="selectSucursal" name='selectSucursal'aria-label="Floating label select example">
                                        <?php   
                                            $query = "SELECT sede, sucursal FROM emb_sede ORDER BY sede ASC";
                                            $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); 
                                            while($fila = mysqli_fetch_array($rs)){  
                                                if($fila['sucursal']==$_SESSION['sucursal']){ ?>
                                                    <option value="<?php echo $fila['sucursal'];  ?>" selected><?php echo $fila['sede']." - ".$fila['sucursal']; ?></option>
                                        <?php       }else{ ?>
                                                        <option value="<?php echo $fila['sucursal'];  ?>"><?php echo $fila['sede']." - ".$fila['sucursal']; ?></option>
                                        <?php       }
                                            }?>
                                    </select>
                                    <label for="floatingSelect">Elige la sede de la Embotelladora Thomsom</label>
                                </div>              
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" value="Cambiar" name="btnCambSede">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <br><br>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modificar sede</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
                                <div class="form-floating">
                                    <select class="form-select" id="selectSucursal" name='selectSucursal'aria-label="Floating label select example">
                                        <?php   while($fila = mysqli_fetch_array($rs)){  
                                                    if($fila['sucursal']==$_SESSION['sucursal']){ ?>
                                                        <option value="<?php echo $fila['sucursal'];  ?>" selected><?php echo $fila['sede']." - ".$fila['sucursal']; ?></option>
                                        <?php       }else{ ?>
                                                        <option value="<?php echo $fila['sucursal'];  ?>"><?php echo $fila['sede']." - ".$fila['sucursal']; ?></option>
                                        <?php       }
                                                }?>
                                    </select>
                                    <label for="floatingSelect">Elige la sede de la Embotelladora Thomsom</label>
                                </div>              
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" value="Cambiar" name="btnCambSede">Cambiar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <h1 class="text-center display-4 separacion-grande-bottom ">REPORTES</h1>

            <div class="row contenido">
                <div class="col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select class="form-select" id="idReporte" name="idReporte" onchange="selectReporte()" aria-label="Floating label select example">
                            <option value="clientes">Clientes</option>
                            <option value="compras">Compras</option>
                            <option value="usuarios">Usuarios</option>
                        </select>
                        <label for="idReporte">Reporte de...</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="contenido contenido-vertical">
                <div class="contenido">
                    <div id="tabla"></div>
                </div>
            </div>
            <br>
            <!-- <div class="row contenido contenido-vertical">
                <div class="col-md-2 col-sm-3">
                    <div class="form-floating">
                        <select class="form-select" id="idFiltro" aria-label="Floating label select example">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        <label for="idFiltro">Filtrar</label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="idBusqueda">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3" Style="padding-top:7px">
                <button type="button" class="btn btn-primary btn-lg">Buscar</button>
                </div>
            </div> -->
        </div>    

    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>