<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php

include "conn.php";

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    if (!empty($_POST["tri"]) && !empty($_POST["turma"]) && !empty($_POST["idAluno"])){
        //analise de dados
        if(!empty($_POST["p1"]) && !empty($_POST["m1"]) && !empty($_POST["ch1"]) && !empty($_POST["ce1"]) && !empty($_POST["ef1"])){
            if(!empty($_POST["p2"]) && !empty($_POST["m2"]) && !empty($_POST["ch2"]) && !empty($_POST["ce2"]) && !empty($_POST["ef2"])){
                if(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
                    //todos os campos
                }else{
                    //apenas 1 e 2
                }
            }else{
                if(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
                    //1 e 3
                }else{
                    //apenas campo 1
                }
            }
        }elseif(!empty($_POST["p2"]) && !empty($_POST["m2"]) && !empty($_POST["ch2"]) && !empty($_POST["ce2"]) && !empty($_POST["ef2"])){
            if(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
                //campo 2 e 3
            }else{
                //campo 2 apenas
            }   
        }elseif(!empty($_POST["p3"]) && !empty($_POST["m3"]) && !empty($_POST["ch3"]) && !empty($_POST["ce3"]) && !empty($_POST["ef3"])){
            //apenas campo 3";
        }else{
            echo "<script>
            alert('nenhum campo preenchido');
            window.location.href = 'pagprincipal.php';
            </script>";
        }
    }else{
        echo "<script>
            alert('erro ao se comunicar com dados essenciais do servidor');
            window.location.href = 'pagprincipal.php';
        </script>";
    }
}