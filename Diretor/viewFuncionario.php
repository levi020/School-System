<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
            include "../conn.php";
            session_start();
            if ($conn->connect_error) {
                echo "server morreu".$conn->connect_errno;
            }else{
                $id = $conn->real_escape_string($_POST["idFunc"]);
                $sql = "SELECT `id`, `user`, `senha`, `cargo`, `image`, `escola`, `ativo` FROM `funcionarios` WHERE `id`='".$id."'";
                $query = $conn->query($sql);
                if($query->num_rows == 0){
                    echo "<script>
                        alert('Erro ao buscar funcionário');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }else{
                    while($row = mysqli_fetch_array($query)){
                        echo "<div>
                        <form action='updtFunc.php' method='post'>
                            <img src='../$row[4]'>
                            <p>Nome: $row[1]</p>
                            <input type='text' name='nome' id='nome' value='$row[1]'>
                            
                            <br>
                            <p>Cargo: $row[3]</p>
                            <br>
                            <p>Escola: $row[5]</p>
                        </form>
                        </div>
                        <div>
                        <form action='delFunc.php' method='post'>
                            <input type='hidden' name='idFunc' id='idFunc' value='$row[0]'>
                            <input type='submit' value='Demitir'>
                        </form>
                        </div>";
                    }
                }
            }
            $conn->close();
        ?>
    </div>
</body>
<script>
    const inp1 = document.getElementById('nome');
    inp1.style.display = "none";
</script>
</html>