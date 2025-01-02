<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <link rel="shortcut icon" href="..\images\iconSistema.jpg" type="image/x-icon">
    <style>
        body{margin: 0;
        font-family: sans-serif;}

        a{text-decoration: none;
        color: black;}

        #land{text-align: center;}

        table {
            width: 70%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 80px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div id="land">
        <br>
        <h1>Lista de Funcionarios</h1>
        <br>
        <button><a href="addFuncionario.php">Adicionar funcionario</a></button>
    </div>
    <hr>
    <div id="table">
        <?php
            session_start(); // Certifique-se de iniciar a sessão
            include "../conn.php";
            
            if ($conn->connect_error) {
                echo "Erro de conexão com o servidor: " . $conn->connect_errno;
            } else {

                $sql = "SELECT `user`, `cargo`, `image`, `escola`,`id` FROM `funcionarios` 
                WHERE `escola`='" . $_SESSION["escola"] . "' AND `ativo`='s' AND `cargo`!='Diretor(a)'";

                try {
                    $query = $conn->query($sql);
                    if ($query->num_rows == 0) {
                        echo "<script>
                            alert('Não foram encontrados funcionários em sua escola');
                            window.location.href = 'pagDiretor.php';
                        </script>";
                    } else {
                        echo "<table>
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Cargo</th>
                                    <th>Imagem</th>
                                    <th>Escola</th>
                                </tr>
                            </thead>
                            <tbody>";
                        
                        while ($row = $query->fetch_assoc()) {
                            echo "<tr>
                                <td> <form action='viewFuncionario.php' method='post'>
                                    <input type='hidden' name='idFunc' id='idFunc' value='".$row["id"]."'>
                                    <input type='submit' value='".$row["user"]."'>
                                </form> 
                                 </td>
                                <td>" . htmlspecialchars($row['cargo']) . "</td>
                                <td><img src='../".htmlspecialchars($row['image']) . "' alt='Imagem do funcionário'></td>
                                <td>" . htmlspecialchars($row['escola']) . "</td>
                            </tr>";
                        }

                        echo "</tbody></table>";
                    }
                } catch (Exception $e) {
                    echo "<script>
                        alert('Erro ao buscar funcionários: " . addslashes($e->getMessage()) . "');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }
            }
        ?>
    </div>
</body>
</html>
