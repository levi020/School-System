<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link rel="shortcut icon" href="favicon.ico" type="../images/iconSistema">
    <style>
        body{
            margin: 0;
            font-family: sans-serif;
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
                $sql = "SELECT `id`, `numTurma`, `profResponsavel`, `mediaTurma`, `escola` FROM `turmas` WHERE `escola`='" . $_SESSION["escola"] . "'";
                $query = $conn->query($sql);
                if ($query->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>
                            <th>Número da Turma</th>
                            <th>Professor Responsável</th>
                            <th>Média da Turma</th>
                            <th>Escola</th>
                          </tr>";
                    while ($row = $query->fetch_assoc()) {
                        echo "<tr>
                                <td><form action='viewTurma.php' method='post'>
                                    <input type='hidden' name='idTurma' id='idTurma' value='".$row["id"]."'>
                                    <input type='submit' value='".$row["numTurma"]."'>
                                </form>
                                </td>
                                <td>" . $row['profResponsavel'] . "</td>
                                <td>" . $row['mediaTurma'] . "</td>
                                <td>" . $row['escola'] . "</td>
                              </tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p style='text-align: center;'>Nenhuma turma encontrada.</p>";
                }
            }
            $conn->close();
        ?>  
    </div>
    
</body>
</html>
