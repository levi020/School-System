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

        input{background-color: lightgray;
        opacity: 0.8;}

        td{text-align: center;}
    </style>
</head>
<body>
    <?php
        include "conn.php";
        session_start();

        if($conn->connect_error){
            echo "server morreu".$conn->connect_errno;
        }else{
            switch($_SESSION["cargo"]){
                
                case "Professor(a)":
                    echo "<table border='1'>";
                    echo "<tr><th>Número da Turma</th><th>Professor Responsável</th><th>Média da Turma</th></tr>";
                    $sql = "SELECT `numTurma`, `profResponsavel`, `mediaTurma` FROM `turmas` WHERE `profResponsavel`='".$_SESSION["user"]."' ORDER BY `numTurma`";
                    $query = $conn->query($sql);
                    try{
                        while($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>
                                    <form action='viewTurma.php' method='post'>
                                        <input type='hidden' name='numTurma' id='numTurma' value='".$row[0]."'>
                                        <input type='submit' id='button' value='".$row[0]."' onmouseover='Escurecer()' onmouseout='Clarear()'>
                                    </form>
                            </td>"; 
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>" . $row[1] . "</td>"; 
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>" . $row[2] . "</td>"; 
                            echo "</tr>";
                        }
                    }
                    catch(Exception $e){
                        echo "<script>
                            alert(".$e.");
                        </script>";
                    }
                    
                    echo "</table>";
                break;

                case "Secretario(a)":
                    echo "";
                break;

                case "Diretor(a)":
                    echo "<table border='1'>";
                    echo "<tr><th>Num Turma</th><th>Professor Responsável</th><th>Média da Turma</th></tr>";
                    $sql = "SELECT `numTurma`, `profResponsavel`, `mediaTurma` FROM `turmas`ORDER BY `numTurma`";
                    $query = $conn->query($sql);
                    while($row = mysqli_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>" . $row[0] . "</td>"; 
                        echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>" . $row[1] . "</td>"; 
                        echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>" . $row[2] . "</td>"; 
                        echo "</tr class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>";
                    }
                    echo "</table>";
                break;
            }
        }
    ?>
    <script>
        function Escurecer(element){
            element.style.backgroundColor = "gray";
            element.style.opacity = "1";
        }
        function Clarear(element){
            element.style.backgroundColor = "lightgray";
            element.style.opacity = "0.8";
        }
    </script>
</body>
</html>