<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link rel="shortcut icon" href="images\iconSistema.jpg" type="image/x-icon">
    <style>
        body{margin: 0;
        font-family: sans-serif;}

        .aluno{background-color: lightgray;
        color: black;
        opacity: 0.8;}
        
        img{width: 60px;
        height: 60px;}

        td{text-align: center;}
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
                switch($_SESSION['cargo']){
                    case "Professor(a)":
                        $turma = $conn->real_escape_string($_POST["numTurma"]);
                        $sql = "SELECT `nome`, `cpf`, `escola`, `turma`, `image`,`status`,`id` FROM `alunos` WHERE `turma`='".$turma."';";
                        $query = $conn->query($sql);
                        echo "<table>";
                        echo "<table border='1'>";
                        echo "<tr><th>Rosto</th><th>Nome do Aluno</th><th>CPF</th><th>Escola</th><th>Turma</th><th>Status</th><th>Visualizar Boletim</th></tr>";
                        while($row = mysqli_fetch_array($query)){
                            echo "<tr>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'><img src='".$row[4]."'></th>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>".$row[0]."</td>"; 
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>".$row[1]."</td>"; 
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>".$row[2]."</td>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>".$row[3]."</td>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>'".$row[5]."'</td>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>
                            <form action='boletim.php' method='post'>
                                <input type='hidden' name='idAluno' id='idAluno' value='$row[6]'>
                                <input type='submit' value='Visualizar'>
                            </form>
                            </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    break;
                }
            }
            $conn->close();
        ?>
    </div>
    <script>
        function Escurecer(element) {
            element.style.backgroundColor = "gray";
            element.style.opacity = "1";
        }

        function Clarear(element) {
            element.style.backgroundColor = "lightgray";
            element.style.opacity = "0.8";
        }
    </script>
</body>
</html>
