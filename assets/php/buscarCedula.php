<?php

    include_once("conexion.php");

    $cedula=$_GET["cedula"];

    $query = 'SELECT nombre, apellido, telefono, direccion FROM emb_cliente WHERE cedula="'.$cedula.'"';
    $rs = mysqli_query($conec, $query) or die('Error: ' . mysqli_error($conec)); 
    $fila = mysqli_fetch_array($rs);

    if(isset($fila)){

        $arreglo["nombre"]=$fila["nombre"];
        $arreglo["apellido"]=$fila["apellido"];
        $arreglo["telefono"]=$fila["telefono"];
        $arreglo["direccion"]=$fila["direccion"];
        echo json_encode($arreglo);
    }else{
        echo json_encode("efe");
    }

?>