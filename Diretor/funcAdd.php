<?php

include "../conn.php";
session_start();

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $nomeFunc = $conn->real_escape_string($_POST["nomeFunc"]);
    $senha = $conn->real_escape_string($_POST["pass"]);
    $cargo = $conn->real_escape_string($_POST["cargo"]);
    $escola = $conn->real_escape_string($_POST["escola"]);
    $destino = "images/";
    function NomeImage($nome){
        
    }
}