<?php

include "../conn.php";
session_start();
if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $senha = $conn->real_escape_string($_POST["senha"]);
    $sqlAnalisa = "SELECT `id`, `user`, `senha`, `cargo`, `image`, `escola`, `ativo` FROM `funcionarios` WHERE `senha`='".$senha."' AND `user`='".$_SESSION["user"]."' AND `image`='".$_SESSION["image"]."'";
    $queryAnalise = $conn->query($sqlAnalisa);
    if ($queryAnalise == true) {
        $id = $conn->real_escape_string($_POST["idFunc"]);
        $sql = "UPDATE `funcionarios` SET `ativo`='n' WHERE `id`='".$id."'";
        $query = $conn->query($sql);
        if($query == true){
            echo "<script>
                alert('Demição feita com sucesso');
                window.location.href = 'pagDiretor.php';
            </script>";
        }else{
            echo "<script>
                alert('Erro ao demitir');
                window.location.href = 'pagDiretor.php';
            </script>";
        }
    }else{
        echo "<script>
            alert('senha incorreta');
            window.location.href = 'pagDiretor.php';
        </script>";
    }
}
$conn->close();