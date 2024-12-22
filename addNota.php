<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images\iconSistema.jpg" type="image/x-icon">
    <title>Document</title>
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

        input[type='text'] {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <div>
        <?php
            include "conn.php";
            session_start();

            if($conn->connect_error){
                echo "server morreu".$conn->connect_errno;
            }else{
                $idaluno = $conn->real_escape_string($_POST["idAluno"]);
                $tri = $conn->real_escape_string($_POST["tri"]);
                $turma = $conn->real_escape_string($_POST["turma"]);

                $sql = $conn->prepare("SELECT `portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica`, `trimestre` FROM `notas` WHERE `trimestre`=? AND `turma`=? AND `aluno_id`=?");
                $sql->bind_param("sss", $tri, $turma, $idaluno);

                $sql->execute();
                $result = $sql->get_result();

                if($result->num_rows == 0){
                    // Caso 0 linhas, criar formulário completo com 3 inputs por matéria
                    echo "<form action='analisa.php' method='POST'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Disciplina</th>
                                    <th>1ª Nota</th>
                                    <th>2ª Nota</th>
                                    <th>3ª Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Português</td>
                                    <td><input type='number' id='p1' name='p1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='p2' name='p2' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='p3' name='p3' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Matemática</td>
                                    <td><input type='number' id='m1' name='m1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='m2' name='m2' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='m3' name='m3' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Ciências Humanas</td>
                                    <td><input type='number' id='ch1' name='ch1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ch2' name='ch2' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ch3' name='ch3' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Ciências Exatas</td>
                                    <td><input type='number' id='ce1' name='ce1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ce2' name='ce2' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ce3' name='ce3' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Educação Física</td>
                                    <td><input type='number' id='ef1' name='ef1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ef2' name='ef2' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ef3' name='ef3' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                                </tr>
                            </tbody>
                        </table>
                        <div style='text-align: center;'>
                            <input type='hidden' name='idAluno' id='idAluno' value='".$idaluno."'>
                            <input type='hidden' name='tri' id='tri' value='".$tri."'>
                            <input type='hidden' name='turma' id='turma' value='".$turma."'>
                            <button type='submit'>Salvar Notas</button>
                        </div>
                    </form>";
                }
                elseif($result->num_rows == 1){
                    // Caso 1 linha, mostrar a nota e criar 2 inputs para cada matéria
                    $row = $result->fetch_assoc();
                    echo "<form action='analisa.php' method='POST'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Disciplina</th>
                                    <th>Notas Anteriores</th>
                                    <th>1ª Nova Nota</th>
                                    <th>2ª Nova Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Português</td>
                                    <td>".$row['portugues']."</td>
                                    <td><input type='number' id='p1' name='p1' placeholder='Nova Nota 1' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='p2' name='p2' placeholder='Nova Nota 2' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Matemática</td>
                                    <td>".$row['matematica']."</td>
                                    <td><input type='number' id='m1' name='m1' placeholder='Nova Nota 1' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='m2' name='m2' placeholder='Nova Nota 2' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Ciências Humanas</td>
                                    <td>".$row['ciencias_humanas']."</td>
                                    <td><input type='number' id='ch1' name='ch1' placeholder='Nova Nota 1' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ch2' name='ch2' placeholder='Nova Nota 2' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Ciências Exatas</td>
                                    <td>".$row['ciencias_exatas']."</td>
                                    <td><input type='number' id='ce1' name='ce1' placeholder='Nova Nota 1' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ce2' name='ce2' placeholder='Nova Nota 2' step='0.10' min='0' max='10'></td>
                                </tr>
                                <tr>
                                    <td>Educação Física</td>
                                    <td>".$row['educacao_fisica']."</td>
                                    <td><input type='number' id='ef1' name='ef1' placeholder='Nova Nota 1' step='0.10' min='0' max='10'></td>
                                    <td><input type='number' id='ef2' name='ef2' placeholder='Nova Nota 2' step='0.10' min='0' max='10'></td>
                                </tr>
                            </tbody>
                        </table>
                        <div style='text-align: center;'>
                            <input type='hidden' name='idAluno' id='idAluno' value='".$idaluno."'>
                            <input type='hidden' name='tri' id='tri' value='".$tri."'>
                            <input type='hidden' name='turma' id='turma' value='".$turma."'>
                            <button type='submit'>Salvar Notas</button>
                        </div>
                    </form>";
                }
                elseif($result->num_rows == 2){
                    // Caso 2 linhas, mostrar as anteriores e criar inputs para as faltantes
                    echo "<form action='analisa.php' method='POST'>
                        <table>
                            <thead>
                                <tr>
                                    <th>Disciplina</th>
                                    <th>Notas Anteriores</th>
                                    <th>Nova Nota</th>
                                </tr>
                            </thead>
                            <tbody>";

                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                            <td>Português</td>
                            <td>".$row['portugues']."</td>
                            <td><input type='number' id='p1' name='p1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                        </tr>
                        <tr>
                            <td>Matemática</td>
                            <td>".$row['matematica']."</td>
                            <td><input type='number' id='m1' name='m1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                        </tr>
                        <tr>
                            <td>Ciências Humanas</td>
                            <td>".$row['ciencias_humanas']."</td>
                            <td><input type='number' id='ch1' name='ch1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                        </tr>
                        <tr>
                            <td>Ciências Exatas</td>
                            <td>".$row['ciencias_exatas']."</td>
                            <td><input type='number' id='ce1' name='ce1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                        </tr>
                        <tr>
                            <td>Educação Física</td>
                            <td>".$row['educacao_fisica']."</td>
                            <td><input type='number' id='ef1' name='ef1' placeholder='Insira a nota' step='0.10' min='0' max='10'></td>
                        </tr>";
                    }

                    echo "</tbody>
                        </table>
                        <div style='text-align: center;'>
                            <input type='hidden' name='idAluno' id='idAluno' value='".$idaluno."'>
                            <input type='hidden' name='tri' id='tri' value='".$tri."'>
                            <input type='hidden' name='turma' id='turma' value='".$turma."'>
                            <button type='submit'>Salvar Notas</button>
                        </div>
                    </form>";

                }elseif($result->num_rows == 3){
                    // Caso 3 linhas, mostrar todas as notas em tabela
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

                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>Português</td>
                                <td>".$row['portugues']."</td>
                                <td>".$row['portugues']."</td>
                                <td>".$row['portugues']."</td>
                            </tr>
                            <tr>
                                <td>Matemática</td>
                                <td>".$row['matematica']."</td>
                                <td>".$row['matematica']."</td>
                                <td>".$row['matematica']."</td>
                            </tr>
                            <tr>
                                <td>Ciências Humanas</td>
                                <td>".$row['ciencias_humanas']."</td>
                                <td>".$row['ciencias_humanas']."</td>
                                <td>".$row['ciencias_humanas']."</td>
                            </tr>
                            <tr>
                                <td>Ciências Exatas</td>
                                <td>".$row['ciencias_exatas']."</td>
                                <td>".$row['ciencias_exatas']."</td>
                                <td>".$row['ciencias_exatas']."</td>
                            </tr>
                            <tr>
                                <td>Educação Física</td>
                                <td>".$row['educacao_fisica']."</td>
                                <td>".$row['educacao_fisica']."</td>
                                <td>".$row['educacao_fisica']."</td>
                            </tr>";
                    }

                    echo "</tbody>
                        </table>";
                }
            }
            $conn->close();
        ?>
    </div>
    <script>
        document.getElementsByTagName("input").addEventListener("change", function(){
        this.value = parseFloat(this.value).toFixed(2);
        });
    </script>
</body>
</html>
