<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="shortcut icon" href="../images/iconSistema.jpg" type="image/x-icon">
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
                $sqlNota = "SELECT `id`, `aluno_id`, `turma`, `portugues`, `matematica`, `ciencias_humanas`, `ciencias_exatas`, `educacao_fisica`, `trimestre` FROM `notas` WHERE `aluno_id`='".$id."'";

                echo "<div class='infos'>";
                while ($row = mysqli_fetch_array()) {
                    # code...
                }
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>