<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <style>
        body{
            margin: 0;
            font-family: sans-serif;
        }
        img{
            width: 100px;
        }
        a{
            text-decoration: none;
            color: black;
        }

        #land{
            text-align: center;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div>
        <?php
            include "../conn.php";
            session_start();

            if($conn->connect_error){
                echo "Server error: " . $conn->connect_errno;
            } else {
                $idTurma = $conn->real_escape_string($_POST["idTurma"]);

                $sql = "SELECT `id`, `image`, `nome`, `cpf`, `escola`, `turma`, `status` FROM `alunos` WHERE `turma`='".$idTurma."'";
                $query = $conn->query($sql);

                if($query->num_rows == 0){
                    echo "<div>
                        <h1>nenhuma turma cadastrada</h1>
                    </div>";
                }else{
                    echo "<table>";
                    echo "<tr>
                        <th>Foto do aluno</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Turma</th>
                        </tr>
                    ";
                    while($row = mysqli_fetch_array($query)){
                        echo "<td><img src='../".$row[1]."'></td>
                        <td><h3>".$row[2]."</h3></td>
                        <td><h3>".$row[3]."</h3></td>
                        <td><h3>".$row[5]."</h3></td>";
                        
                    }
                    echo "</table>";
                }
            }
            $conn->close();
        ?>
    </div>
</body>
</html>