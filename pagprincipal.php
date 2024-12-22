<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Professor(a)</title>
    <link rel="shortcut icon" href="images\iconSistema.jpg" type="image/x-icon">
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
        left: 40%;
        }

        #p2{position: absolute;
        top: 15.5%;
        right: 37%;}

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
            include "conn.php";
            echo $_SESSION["user"]; 
        ?>
        </h1>
        <img src="<?php echo $_SESSION["image"]; ?>" >
        <?php
            echo "<h5 class='date'>".date("d-m-Y")."</h5>";
        ?>
        <br>
        <p id="p1"><a href="notas.php">Notas</a></p>
        <p style="text-align:center;"><a href="turmas.php">Ver suas Turmas</a></p>
        <p id="p2"><a href="sair.php">Desconectar</a></p>
        <form action="pagprincipal.php"></form>
    </div>
    <div>
        <h3>Adicionar algo ao diário</h3>
        <form action="addObservacao.php" method="post">
            <label for="notas">Deixe sua observacao</label>
            <br>
            <input type="text" name="notas" id="notas" required>
            <br>
            <select name="turma" id="turma" required>

            </select>
            <br>
            <input type="submit" value="Adicionar" >
        </form>
        
    </div>
    <div class="observacoes">
        <?php
            if($conn->connect_error){
                echo "server morreu".$conn->connect_errno;
            }else{
                $sql = "SELECT `turma`, `data`, `anotacoes`,`id` FROM `diario` WHERE `numFuncionario`='".$_SESSION["user"]."' AND `visivel`='s' ORDER BY `data` DESC ;";
                $query = $conn->query($sql);
                try{
                    while($row = mysqli_fetch_array($query)){
                        echo "<div>
                        <h4>Nota do dia: $row[1], sobre a turma: $row[0]</h4>
                        <p>&emsp;$row[2]</p>
                        <form action='pagprincipal.php' method='post'>
                            <input type='hidden' name='id' id='id' value='$row[3]'>
                            <input type='submit' value='Excluir'>
                        </form>
                        <hr>
                        </div>";
                    }
                }catch(Exception $e){
                    echo "
                    <script>
                        alert('".$e."');
                    </script>";
                }
            }
        ?>
        
    </div>
    <?php
        if(empty($_SESSION["user"])){
            header("location:index.php", true, 301);
        }
    ?>
    <script>
        function Preencher() {
            var xhr = new XMLHttpRequest(); 
            xhr.open('GET', 'puxarTurma.php', true); 

            xhr.onload = function() {
            if (xhr.status === 200) { 
                try {
                    var resposta = JSON.parse(xhr.responseText); 
                    var listaEscolas = document.getElementById('turma'); 

                    listaEscolas.innerHTML = '';
                    var optionDefault = document.createElement('option');
                    optionDefault.value = '';
                    optionDefault.textContent = 'Selecione a turma';
                    listaEscolas.appendChild(optionDefault);
                    if (resposta.error) {
                        alert(resposta.error);
                        return;
                    }

                    resposta.forEach(function(turma) {
                        var option = document.createElement('option');
                        option.value = turma;
                        option.textContent = turma;
                        listaEscolas.appendChild(option);
                    });
                } catch (e) {
                    console.error("Erro ao parsear JSON:", e);
                    alert("Erro no formato da resposta do servidor.");
                }
            } else {
                alert('Erro ao carregar as turmas. Código: ' + xhr.status);
            }
            };

            xhr.onerror = function() {
                alert('Erro de rede ou no servidor.');
            };

            xhr.send(); 
        }
    Preencher(); 
    </script>
    <?php
        if(isset($_POST["id"])){
            $id = $conn->real_escape_string($_POST["id"]);
            $sql = "UPDATE `diario` SET `visivel`='n' WHERE `id`='".$id."'";
            $query = $conn->query($sql);
            sleep(1);
        }
        $conn->close();
    ?>
</body>
</html>