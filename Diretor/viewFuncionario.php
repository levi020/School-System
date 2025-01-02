<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <link rel="shortcut icon" href="../images/iconSistema.jpg" type="image/x-icon">
    <style>
        .imgUpt{width: 25px;
        height: 25px;}

        .foto{border-radius: 100%;
        width: 500px;
        height: 300px;}
    </style>
</head>
<body>
    <div>
        <?php
            include "../conn.php";
            session_start();
            if ($conn->connect_error) {
                echo "server morreu".$conn->connect_errno;
            }else{
                $id = $conn->real_escape_string($_POST["idFunc"]);
                $sql = "SELECT `id`, `user`, `senha`, `cargo`, `image`, `escola`, `ativo` FROM `funcionarios` WHERE `id`='".$id."'";
                $query = $conn->query($sql);
                if($query->num_rows == 0){
                    echo "<script>
                        alert('Erro ao buscar funcionário');
                        window.location.href = 'pagDiretor.php';
                    </script>";
                }else{
                    while($row = mysqli_fetch_array($query)){
                        echo "<div>
                        <img src='../$row[4]' class='foto'>

                        <form action='confirm.php' method='post'>
                        <img src='Load.png' class='imgUpt' onclick='Load()'>

                            <input type='hidden' name='idFunc' id='idFunc' value='".$id."'>
                            <input type='hidden' name='cargoA' id='cargoA' value='".$row[3]."'>
                            <br>
                            <p id='nomeP'>Nome: $row[1]</p>
                            <input type='text' name='nome' id='nome' value='$row[1]'>
                            <img src='lapis.png' class='imgUpt' onclick='MostrarInpNome()' name='img1' id='img1'>
                            <br>

                            <p id='cargoP'>Cargo: $row[3]</p>
                            <img src='lapis.png' class='imgUpt' onclick='MostrarInpCargo()' name='img2' id='img2'>

                            <select name='cargo' id='cargo' required>
                                <option default>Selecione o Cargo</option>
                                <option value='Professor(a)'>Professor(a)</option>
                                <option value='Secretario(a)'>Secretario(a)</option>
                                <option value='Diretor(a)'>Diretor(a)</option>
                            </select>

                            <br>
                            <p id='school'>Escola: $row[5]</p>
                            <img src='lapis.png' class='imgUpt' onclick='MostrarInpEscola()' name='img3' id='img3'>

                            <select name='escola' id='escola'>
                
                            </select>
                            <br>
                            <input type='submit' value='Mudar' id='sub'>
                        </form>
                        </div>
                        <br>
                        <div>
                        <form action='confirmExcluir.php' method='post'>
                            <input type='hidden' name='idFunc' id='idFunc' value='$row[0]'>
                            <input type='submit' value='Demitir'>
                        </form>
                        </div>";
                    }
                }
            }
            $conn->close();
        ?>
    </div>
</body>
<script>
    const inp1 = document.getElementById('nome');
    inp1.style.display = "none";
    
    const inp2 = document.getElementById("cargo");
    inp2.style.display = "none";

    const inp3 = document.getElementById('escola');
    inp3.style.display = "none";
    
    const sub = document.getElementById("sub");
    sub.style.display = "none";
    
    function MostrarInpNome(){
        document.getElementById("img1").style.display = "none";
        document.getElementById("nomeP").style.display = "none";
        inp1.style.display = "block";
        sub.style.display = "block";
    }

    function MostrarInpCargo(){
        document.getElementById("img2").style.display = "none";
        document.getElementById("cargoP").style.display = "none";
        inp2.style.display = "block";
        sub.style.display = "block";

    }

    function MostrarInpEscola(){
        document.getElementById("img3").style.display = "none";
        document.getElementById("school").style.display = "none";
        inp3.style.display = "block";
        sub.style.display = "block";
    }

    function Load(){
        inp1.style.display = "none";
        inp2.style.display = "none";
        inp3.style.display = "none";
        sub.style.display = "none";

        document.getElementById("img1").style.display = "block";
        document.getElementById("img2").style.display = "block";
        document.getElementById("img3").style.display = "block";

        document.getElementById("nomeP").style.display = "block";
        document.getElementById("cargoP").style.display = "block";
        document.getElementById("school").style.display = "block";
    }
    
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
</html>