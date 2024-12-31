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
        <h1>Para continuar, voce deve inserir sua senha</h1>
        <form action="delFunc.php" method="post">
            <input type="hidden" name="idFunc" id="idFunc" value="<?php echo $_POST["idFunc"]; ?>">
            <input type="password" name="senha" id="senha" required>
            <br>
            <input type="submit" value="Prosseguir">
        </form>
    </div>
</body>
</html>