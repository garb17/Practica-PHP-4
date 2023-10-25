<?php

    include_once("conexion.php");

    $tbusqueda=$_GET["tabla"];

    if($tbusqueda=="cliente"){
        $query = 'SELECT * FROM emb_cliente';
        $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); 
        $fila = mysqli_fetch_array($rs);

        if(isset($fila)){
            echo $fila;
        }
    }

?>