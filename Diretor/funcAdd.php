<?php

include "../conn.php";
session_start();

function NomeImage($nome, $extensao){
    $data = date("d-m-Y");
    $numRamdom = rand(1000,9999);
    $nomeArquivo = $nome . "-" . $data . "-" . $numRamdom . "." .$extensao;
    return $nomeArquivo;
}


if($conn->connect_error){
    echo "server morreu".$conn->connect_errno;
}else{
    $nomeFunc = $conn->real_escape_string($_POST["nomeFunc"]);
    $senha = $conn->real_escape_string(hash("sha512" , $_POST["pass"]));
    $cargo = $conn->real_escape_string($_POST["cargo"]);
    $escola = $conn->real_escape_string($_POST["escola"]);

    $destino = "images/";
    $pasta = "../images/";

    if (!is_dir($pasta)) {
       mkdir($pasta, 0777, true);
       echo "erro"; 
    }

    if(isset($_FILES["file"])){
        $extensao = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
        $nome = NomeImage($nomeFunc, $extensao);
        $caminhoImagemSalvar = $pasta . $nome;
        $caminhoSql = $destino . $nome;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $caminhoImagemSalvar)) {
            if (!file_exists($caminhoImagemSalvar)) {
                echo "Erro: o arquivo não foi movido para a pasta.";
                exit;
            }
            $sql = "INSERT INTO `funcionarios`(`user`, `senha`, `cargo`, `image`, `escola`, `ativo`) VALUES ('".$nomeFunc."','".$senha."','".$cargo."','".$caminhoSql."','".$escola."','s')";
            if($conn->query($sql)){
                echo "<script>
                    alert('Funcionário adicionado com sucesso');
                    window.location.href = 'pagDiretor.php';
                </script>";
            }
        }else{
            echo "<script>
                    alert('ERROR,Funcionário não foi adicionado');
                    window.location.href = 'pagDiretor.php';
                </script>";
        }
    }
    
}
$conn->close();