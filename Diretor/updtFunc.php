<?php

include "../conn.php";
session_start();

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $id = $conn->real_escape_string(hash("sha512", $_POST["senha"]));
    $sql = "";
}