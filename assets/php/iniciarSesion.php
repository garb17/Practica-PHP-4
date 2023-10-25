<?php
    session_start();
    include_once("conexion.php");

    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    $query = 'SELECT cedula FROM emb_usuario WHERE correo="'.$correo.'" AND contrasena="'.$contrasena.'"';
    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); 
    $fila = mysqli_fetch_array($rs);

    if(isset($fila)){
        $_SESSION['id_usuario']=$fila;
        echo "correcto";
    }else{
        echo "efe";
    }
        
?>