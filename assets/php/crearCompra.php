<?php
    session_start();
    include_once("conexion.php");

    if(isset($_POST['cedula'])&&(!empty($_POST['cedula'])||$_POST['cedula']=="0")){
        if(isset($_POST['nombre'])&&(!empty($_POST['nombre'])||$_POST['nombre']=="0")){
            if(isset($_POST['apellido'])&&(!empty($_POST['apellido'])||$_POST['apellido']=="0")){
                if(isset($_POST['telefono'])&&(!empty($_POST['telefono'])||$_POST['telefono']=="0")){
                    if(isset($_POST['direccion'])&&(!empty($_POST['direccion'])||$_POST['direccion']=="0")){
                        if(isset($_POST['precio'])&&(!empty($_POST['precio'])||$_POST['precio']=="0")){
                            if(isset($_POST['cantidad'])&&(!empty($_POST['cantidad'])||$_POST['cantidad']=="0")){
                                if(!$_POST['cedula']<1&&ctype_digit($_POST['cedula'])){
                                    if(ctype_alpha($_POST['nombre'])){
                                        if(ctype_alpha($_POST['apellido'])){
                                            if(ctype_digit($_POST['telefono'])){
                                                if(strlen($_POST['telefono'])!=11){
                                                    if($_POST['precio']>0&&is_numeric($_POST['precio'])){
                                                        if($_POST['cantidad']>=1&&ctype_digit($_POST['cantidad'])){
    
                                                            $cedula=$_POST['cedula'];
                                                            $nombre=$_POST['nombre'];
                                                            $apellido=$_POST['apellido'];
                                                            $telefono=$_POST['telefono'];
                                                            $direccion=$_POST['direccion'];
    
                                                            // En caso de no estar registrado el cliente, se guarda en la bdd
                                                            $query='SELECT * from emb_cliente WHERE cedula="'.$cedula.'"';
                                                            $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
                                                            $fila = mysqli_fetch_array($rs);
    
                                                            if(!isset($fila)){
                                                                $query='INSERT INTO emb_cliente(cedula, nombre, apellido, telefono, direccion) VALUES ("'.$cedula.'","'.$nombre.'","'.$apellido.'","'.$telefono.'","'.$direccion.'")';
                                                                $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
                                                            }
    
                                                            // Se crea la compra del cliente
                                                            date_default_timezone_set('America/Caracas');
                                                            $precio=floatval($_POST['precio']);
                                                            $cantidad=intval($_POST['cantidad']);
                                                            $total=$precio*$cantidad;
                                                            $fecha=date("Y-m-d");
                                                            $hora=date("h:i:sa");
                            
                                                            $query='SELECT id FROM emb_sede WHERE sucursal="'.$_SESSION['sucursal'].'"';
                                                            $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
                                                            $fila = mysqli_fetch_array($rs);
                            
                                                            $id_sede=$fila[0];
                                                            $cedula_cliente=$cedula;
                                                            $cedula_usuario=$_SESSION['id_usuario'][0];
                            
                                                            $query='INSERT INTO emb_compra(precio, cantidad, fecha, hora, total, id_sede, cedula_cliente, cedula_usuario) VALUES ('.$precio.','.$cantidad.',"'.$fecha.'","'.$hora.'",'.$total.',"'.$id_sede.'","'.$cedula_cliente.'","'.$cedula_usuario.'")';
                                                            $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec));
                                                            
                                                            $arreglo["respuesta"]="Compra guardada con exito";
                                                            
                                                        }else{
                                                            $arreglo["respuesta"]="Error, cantidad invalida";
                                                        }
                                                    }else{
                                                        $arreglo["respuesta"]="Error, precio invalido";
                                                    }
                                                }else{
                                                    $arreglo["respuesta"]="Error, la longitud del telefono es invalido";
                                                }
                                            }else{
                                                $arreglo["respuesta"]="Error, el campo telefono debe ser de tipo numerico";
                                            }
                                        }else{
                                            $arreglo["respuesta"]="Error, el campo apellido debe ser de tipo alfabetico";
                                        }
                                    }else{
                                        $arreglo["respuesta"]="Error, el campo nombre debe ser de tipo alfabetico";
                                    }
                                }else{
                                    $arreglo["respuesta"]="Error, cedula invalida";
                                }
                            }else{
                                $arreglo["respuesta"]="Error, campo cantidad esta vacio";
                            }
                        }else{
                            $arreglo["respuesta"]="Error, campo precio esta vacio";
                        }
                    }else{
                        $arreglo["respuesta"]="Error, campo direccion esta vacio";
                    }
                }else{
                    $arreglo["respuesta"]="Error, campo telefono esta vacio";
                }
            }else{
                $arreglo["respuesta"]="Error, campo apellido esta vacio";
            }
        }else{
            $arreglo["respuesta"]="Error, campo nombre esta vacio";
        }
    }else{
        $arreglo["respuesta"]="Error, campo cedula esta vacio";
    }

    echo json_encode($arreglo);
       

?>