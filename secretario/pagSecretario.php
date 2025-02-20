<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/iconSistema.jpg" type="image/x-icon">
    <title>Pagina Diretor(a)</title>
    <style>
        body{margin: 0;
        font-family: sans-serif;}

        img{
            width: 200px;
            border-radius: 100%;
            position: absolute;
            top: 30px;
            left: 20px;
        }
        h1{text-align: center;
        }
        
        .landpage{border-bottom: 1px solid black;
        height: 200px;}

        #p1{position: absolute;
        top: 15.5%;
        left: 39%;
        }

        #p2{position: absolute;
        top: 15.5%;
        right: 37.5%;}

        .observacoes{width: 400px;
        text-align: center;
        position: absolute;
        top: 13em;
        right: 35em;}

        .date{position: absolute;
        top: 10em;
        left: 6em;}
    </style>
</head>
<body>
<div class="landpage">
        <br>
        <h1>Seja Bem Vindo(a)
        <?php
            session_start();
            include "..\conn.php";
            if(empty($_SESSION["user"])){
                header("location: ../index.php", true,301);
            }else{
                echo $_SESSION["user"];
            }
        ?>
        </h1>
        <?php
        $var = "../" . $_SESSION["image"];
        echo '<img src="' . htmlspecialchars(trim($var)) . '" alt="Imagem">'; 
        ?>
        <?php
            echo "<h5 class='date'>".date("d-m-Y")."</h5>";
        ?>
        <br>
        <p id="p1"><a href="">Adicionar aluno</a></p>
        <p style="text-align:center;"><a href="funcionarios.php">Adicionar turma</a></p>
        <p id="p2"><a href="../sair.php">Desconectar</a></p>
        <form action="pagprincipal.php"></form>
    </div>
</body>
</html>