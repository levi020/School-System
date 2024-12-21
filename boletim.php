<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletim</title>
</head>
<body>
    <div>
        <?php
            include "conn.php";
            session_start();
            if($conn->connect_error){
                echo "server morreu".$conn->connect_errno;
            }else{
                $id = $conn->real_escape_string($_POST["idAluno"]);

                $sql = "SELECT `trimestre`,`portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica` FROM `boletim` WHERE `aluno_id` = '".$id."';";
                $query = $conn->query($sql);
                if($query->num_rows == 0){
                    echo "Não foi encontrado nenhum boletim";
                }else{
                    echo "<table>";
                    while($row = mysqli_fetch_array($query)){
                        echo "";
                    }
                    echo "</table>";
                }
            }
        ?>
    </div>
</body>
</html>