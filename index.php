<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="images\iconSistema.jpg" type="image/x-icon">
    <style>
        body{
            margin: 0;
            font-family: sans-serif;
        }

        #formulario{
            border: 1px solid black;
            background-color: #93bfff;
            width: 300px;
            box-shadow: 1px 1px black;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div>
        <h1 style="text-align:center">Login</h1>
    </div>
    <center>
    <div id="formulario" onmouseover="escurecer()" onmouseout="clarear()">
        <form action="analisaLogin.php" method="post">
            <label for="nome">Insira seu nome</label>
            <br>
            <input type="text" name="nome" id="nome" required>
            <br>
            <label for="cargo">Insira seu cargo</label>
            <br>
            <select name="cargo" id="cargo" required>
                <option default>Selecione o Cargo</option>
                <option value="Professor(a)">Professor(a)</option>
                <option value="Secretario(a)">Secreário(a)</option>
                <option value="Diretor(a)">Diretor(a)</option>
            </select>
            <br>
            <label for="escola">Insira qual sua escola:</label>
            <br>
            <select name="escola" id="escola" required>
                
            </select>
            <br>
            <label for="senha">Insira sua senha</label>
            <br>
            <input type="text" name="senha" id="senha" required>
            <br>
            <input type="submit" value="Conectar">
        </form>
    </div>
    </center>
</body>
<script>
    let divCargo = document.getElementById("formulario");
    var item = [];
    function escurecer(){
        divCargo.style.backgroundColor = "#6387bb";
        divCargo.style.opacity = "1.0";
    }
    
    function clarear(){
        divCargo.style.backgroundColor = "#93bfff"; 
        divCargo.style.opacity = "0.8r";
    }
    function Preencher(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'consulta.php', true);

        xhr.onload = function() {
            if (xhr.status == 200) {
                var escolas = JSON.parse(xhr.responseText);
                var listaEscolas = document.getElementById('escola');
                listaEscolas.innerHTML = ''; 
                var optionDefault = document.createElement('option');
                optionDefault.value = '';
                optionDefault.textContent = 'Selecione a Escola';
                listaEscolas.appendChild(optionDefault);

                escolas.forEach(function(escola) {
                    var option = document.createElement('option');
                    option.value = escola; 
                    option.textContent = escola;
                    listaEscolas.appendChild(option);
                });
            } else {
                alert('Erro ao carregar as escolas');
            }
        };

        xhr.send();
    }
    Preencher();
</script>
</html>
