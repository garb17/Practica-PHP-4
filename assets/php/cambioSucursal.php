<?php 

    session_start();

    $_SESSION['sucursal']=$_GET['sucursal'];
    $arreglo["resultado"]="ok";

    echo json_encode($arreglo);

?>