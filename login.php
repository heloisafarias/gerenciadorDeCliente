<?php

require 'config.php';

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "gerenciadorcli";

try {
    $conexao = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $password = $nameError = $passwordError = $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameError = "Usuário inválido";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["password"])) {
            $passwordError = "Senha inválida";
        } else {
            $password = test_input($_POST["password"]);
        }
    }

    if (empty($nameError) && empty($passwordError)) {
        $stmt = $conexao->prepare("SELECT id FROM user WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $name);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            session_start();
            $_SESSION["name"] = $name;
            header("Location: index.php");
            exit();
        } else {
            $error = "E-mail ou senha incorreta";
        }
    }
} catch (PDOException $exception) {
    echo "ERRO: " . $exception->getMessage();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/stylelogin.css">
</head>
<body>

<div class="container">
    <h1>LOG IN</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>
            E-mail <input type="text" name="name" value="<?= $name; ?>" />
            <span class="error"><?= $nameError; ?></span>
        </label>
        <label>
            Senha <input type="password" name="password" value="<?= $password; ?>" />
            <span class="error"><?= $passwordError; ?></span>
        </label>

        <input type="submit" value="Log in" />
    </form>
</div>

</body>
</html>
