<?php

session_start();
$hostname = "localhost";
$user= "root";
$pass = "";
$db = "escola";

$conn = new mysqli($hostname, $user, $pass, $db);

if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $turma = $conn->real_escape_string($_POST["turma"]);
    $idAluno = $conn->real_escape_string($_POST["idAluno"]);
    $tri = $conn->real_escape_string($_POST["tri"]);

    if(!empty($tri) && !empty($idAluno) && !empty($turma)){
        $p1 = doubleval($_POST["p1"]);
        $p2 = doubleval($_POST["p2"]);
        $p3 = doubleval($_POST["p3"]);

        $m1 = doubleval($_POST["m1"]);
        $m2 = doubleval($_POST["m2"]);
        $m3 = doubleval($_POST["m3"]);

        $ch1 = doubleval($_POST["ch1"]);
        $ch2 = doubleval($_POST["ch2"]);
        $ch3 = doubleval($_POST["ch3"]);

        $ce1 = doubleval($_POST["ce1"]);
        $ce2 = doubleval($_POST["ce2"]);
        $ce3 = doubleval($_POST["ce3"]);

        $ef1 = doubleval($_POST["ef1"]);
        $ef2 = doubleval($_POST["ef2"]);
        $ef3 = doubleval($_POST["ef3"]);

        if(!empty($p1) && !empty($m1) && !empty($ch1) && !empty($ce1) && !empty($ef1)){
            if(!empty($p2) && !empty($m2) && !empty($ch2) && !empty($ce2) && !empty($ef2)){
                if(!empty($p3) && !empty($m3) && !empty($ch3) && !empty($ce3) && !empty($ef3)){
                    echo "todos os campos foram preenchidos";
                }else{
                    
                }
            }
        }elseif(!empty($p2) && !empty($m2) && !empty($ch2) && !empty($ce2) && !empty($ef2)){

        }elseif(!empty($p3) && !empty($m3) && !empty($ch3) && !empty($ce3) && !empty($ef3)){

        }else{
            echo "<script>
                alert('nenhum campo foi inserido');
                window.location.href = 'pagprincipal.php';
            </script>";
        }
    }else{
        echo "<script>
            alert('Falha, dados do servidor');
            window.location.href = 'pagprincipal.php';
        </script>";
    }
}