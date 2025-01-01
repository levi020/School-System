<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Funcionário</title>
    <link rel="shortcut icon" href="..\images\iconSistema.jpg" type="image/x-icon">
    <style>
        body{margin: 0;
        font-family: sans-serif;}

        h1{text-align: center;}
    </style>
</head>
<body>
    <div>
        <br>
        <h1>Insira as Informções</h1>
        <br>
    </div>
    <div>
        <form action="funcAdd.php" method="post">
            <label for="file">Insira a foto do funcionário</label>
            <br>
            <input type="file" name="file" id="file" required>
            <br>
            <label for="nomeFunc">Insira o nome do funcionário</label>
            <br>
            <input type="text" name="nomeFunc" id="nomeFunc" required>
            <br>
            <label for="pass">Insira a senha</label>
            <br>
            <input type="password" name="pass" id="pass" required>
            <br>
            <select name="cargo" id="cargo" required>
                <option default>Selecione o Cargo</option>
                <option value="Professor(a)">Professor(a)</option>
                <option value="Secretario(a)">Secreário(a)</option>
                <option value="Diretor(a)">Diretor(a)</option>
            </select>
            <br>
            <select name="escola" id="escola" required>

            </select>
            <br>
            <input type="submit" value="Enviar">
        </form>
    </div>
    <script>
        function Preencher(){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../consulta.php', true); 

        xhr.onload = function() {
            if (xhr.status == 200) {
                try {
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
                } catch (e) {
                    alert('Erro ao processar as escolas: ' + e.message);
                }
            } else {
                alert('Erro ao carregar as escolas: ' + xhr.status);
            }
        };

        xhr.send();
    }

    Preencher();
    </script>
</body>
</html>