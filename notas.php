<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <form action="notas.php" method="post">
            <select name="turma" id="turma" required>

            </select>
            <br>
            <select name="tri" id="tri" required>
                <option value="" default>Escolha o trimestre</option>
                <option value="1">1º Trimestre</option>
                <option value="2">2º Trimestre</option>
                <option value="3">3º Trimestre</option>
            </select>
            <br>
            <input type="submit" value="Visualizar">
        </form>
    </div>
    <div>
        <?php
            include "conn.php";
            session_start();

            if($conn->connect_error){
                echo "server morreu".$conn->connect_errno;
            }else{
                if(isset($_POST["turma"])){
                    $turma = $conn->real_escape_string($_POST["turma"]);
                    $sql = "SELECT `nome`, `cpf`, `escola`, `turma`, `image`,`status`,`id` FROM `alunos` WHERE `turma`='".$turma."';";
                        $query = $conn->query($sql);
                        echo "<table>";
                        echo "<table border='1'>";
                        echo "<tr><th>Rosto</th><th>Nome do Aluno</th><th>CPF</th><th>Adicionar as Notas</th></tr>";
                        while($row = mysqli_fetch_array($query)){
                            echo "<tr>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'><img src='".$row[4]."'></th>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>".$row[0]."</td>"; 
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>".$row[1]."</td>";
                            echo "<td class='aluno' onmouseover='Escurecer(this)' onmouseout='Clarear(this)'>
                            <form action='addNota.php' method='post'>
                                <input type='hidden' name='turma' id='turma' value='$row[3]'>
                                <input type='hidden' name='tri' id='tri' value='".$_POST["tri"]."'>
                                <input type='hidden' name='idAluno' id='idAluno' value='$row[6]'>
                                <input type='submit' value='Adicionar Nota'>
                            </form>
                            </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                }
            }
        ?>
    </div>
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