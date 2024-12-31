<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação</title>
    <link rel="shortcut icon" href="../images/iconSistema.jpg" type="image/x-icon">
</head>
<body>
    <div>
        <h1>Para continuar, voce deve chamar o <?php echo $_POST["cargoA"];?> e pedir para ele inserir a senha dele.</h1>
        <form action="updtFunc.php" method="post">
            <input type="hidden" name="id" id="id" value="<?php echo $_POST["idFunc"]; ?>">
            <input type="hidden" name="nomeNew" id="nomeNew" value="<?php echo $_POST["nome"]; ?>">
            <input type="hidden" name="cargo" id="cargo" value="<?php echo $_POST["cargo"]; ?>">
            <input type="hidden" name="escola" id="escola" value="<?php echo $_POST["escola"]; ?>">
            <input type="password" name="senha" id="senha" required>
            <br>
            <input type="submit" value="Prosseguir">
        </form>
    </div>
</body>
</html>