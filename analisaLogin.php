<?php
include "conn.php";

if($conn -> connect_error){
    echo "server morreu" . $conn->connect_errno;
}else{
    $nome = $conn->real_escape_string($_POST["nome"]);
    $senha = hash("sha512", $conn->real_escape_string($_POST["senha"]));
    $cargo = $conn->real_escape_string($_POST["cargo"]);
    $escola = $conn->real_escape_string($_POST["escola"]);
    $sql = "SELECT `user`,`cargo`, `image`,`escola` FROM `funcionarios` WHERE `senha`='".$senha."' AND `user`='".$nome."' AND`cargo`='".$cargo."' AND `escola`='".$escola."' AND `ativo`='s'";
    $query = $conn->query($sql);
    try{
        if($query->num_rows == 0){
            echo "<script>
                    alert('login mal-sucedido');
                    window.location.href = 'index.php';
                </script>";
        }else{
            session_start();
            $row = mysqli_fetch_array($query);
            $_SESSION["user"] = $row[0];
            $_SESSION["cargo"] = $row[1];
            $_SESSION["image"] = $row[2];
            $_SESSION["escola"] = $row[3];
            
            if($_SESSION["cargo"] == "Professor(a)"){
                echo "<script>
                    alert('login bem-sucedido');
                    window.location.href = 'pagprincipal.php';
                </script>";
            }else if($_SESSION["cargo"] == "Secretario(a)"){
                echo "<script>
                    alert('login bem-sucedido');
                    window.location.href = 'secretario/pagSecretario.php';
                </script>";
            }else{
                echo "<script>
                    alert('login bem-sucedido');
                    window.location.href = 'Diretor/pagDiretor.php';
                </script>";
            }
            
            
        }
    }catch(Exception $e){
        echo "<script>
        alert('".$e."')
        window.location.href = 'index.php';";
    }
    
    $conn->close();
}