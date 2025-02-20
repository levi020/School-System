<?php
include "../conn.php";
session_start();

if($conn->connect_error){
    echo "Server error: " . $conn->connect_errno;
} else {
    $id = $_POST["id"];
    if(empty($id)){
        echo "<script>
                alert('Erro de pesquisa de aluno');
                window.location.href = 'pagDiretor.php';
            </script>";
    }else{
        $sql = "DELETE FROM `escola` WHERE `id`='".$id."'";
        if($conn->query($sql) == true){
            echo "<script>
                alert('sucesso ao apagar cadastro do aluno');
                window.location.href = 'pagDiretor.php';
            </script>";
        }else{
            echo "<script>
                alert('erro ao apagar cadastro do aluno');
                window.location.href = 'pagDiretor.php';
            </script>";
        }
    }
}
$conn->close();