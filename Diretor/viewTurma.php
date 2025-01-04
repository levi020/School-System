<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
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

                $sql = "";
            }
            $conn->close();
        ?>
    </div>
</body>
</html>