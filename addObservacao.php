<?php

include "conn.php";
session_start();

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $date = date("d/m/Y");
    $turma = $conn->real_escape_string($_POST["turma"]);
    $notas = $conn->real_escape_string($_POST["notas"]);

    $sql = "INSERT INTO `diario`(`turma`, `data`, `anotacoes`, `cargo`, `numFuncionario`,`visivel`) VALUES
    ('".$turma."','".$date."','".$notas."','".$_SESSION["cargo"]."','".$_SESSION["user"]."','s')";
    $query = $conn->query($sql);
    if($query == true){
        header("location: pagprincipal.php", true, 301);
    }else{
        echo "
        <script>
            alert('erro ao inserir anotação');
            window.location.href = 'pagprincipal.php';
        </script>";
    }
}