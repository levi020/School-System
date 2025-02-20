<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="shortcut icon" href="../images/iconSistema.jpg" type="image/x-icon">
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        img{border-radius: 100%;
        width: 250px;}
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
                $id = $conn->real_escape_string($_POST["id"]);
                $sqlInfos = "SELECT `id`, `image`, `nome`, `cpf`, `escola`, `turma`, `status` FROM `alunos` WHERE `id`='".$id."';";
                $sqlNota1 = "SELECT `portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica`, `trimestre` FROM `notas` WHERE `aluno_id`='".$id."'";

                $queryInfo = $conn->query($sqlInfos);
                $result = $conn->query($sqlNota1);
                echo "<div class='infos'>";
                while ($row = mysqli_fetch_array($queryInfo)) {
                    echo "<img src='../$row[1]'>
                    <br>
                    <h2>$row[2]</h2>
                    <br>
                    <p>$row[3]</p>
                    ";
                }
                echo "
                <form action='desativar.php' method='post'>
                    <input type='hidden' name='id' id='id' value='".$id."'>
                    <input type='submit' value='Desativar Cadastro'>
                </form>
                
                </div>";

                echo "<div class='boletim'>";
                echo "<table>
                        <thead>
                            <tr>
                            <th>Disciplina</th>
                            <th>1ª Nota</th>
                            <th>2ª Nota</th>
                            <th>3ª Nota</th>
                            </tr>
                        </thead>
                        <tbody>";
                if($result->num_rows != 0){
                    $notas = [];
                    while($row = $result->fetch_assoc()){
                        $notas[] = $row;
                    }
                    $disciplinas = ['portugues', 'matematica', 'ciencias_humanas', 'ciencias_exatas', 'educacao_fisica'];
                        foreach ($disciplinas as $disciplina) {
                            echo "<tr>
                                    <td>" . ucfirst(str_replace('_', ' ', $disciplina)) . "</td>
                                    <td>" . $notas[0][$disciplina] . "</td>
                                    <td>" . $notas[1][$disciplina] . "</td>
                                    <td>" . $notas[2][$disciplina] . "</td>
                                </tr>";
                        }
                }else{
                    echo "<h5><b>Sem Dados o Suficiente</b></h5>";
                }
                echo "</tbody>
                </table>";
                echo "</div>";
            }
            $conn->close();
        ?>
    </div>
    
</body>
</html>