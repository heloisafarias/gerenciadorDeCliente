<?php
require '../config.php';

$id = filter_input(INPUT_GET, 'id');
$cliente = [];

if (!$id) {
    header("Location: ../index.php");
    exit;
}

$sql_cliente = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
$sql_cliente->bindValue(':id', $id);
$sql_cliente->execute();

if ($sql_cliente->rowCount() > 0) {
    $cliente = $sql_cliente->fetch(PDO::FETCH_ASSOC);

    $sql_endereco = $pdo->prepare("SELECT * FROM endereco WHERE cliente_id = :cliente_id");
    $sql_endereco->bindValue(':cliente_id', $id);
    $sql_endereco->execute();

    if ($sql_endereco->rowCount() > 0) {
        $endereco = $sql_endereco->fetch(PDO::FETCH_ASSOC);
    } else {
        $endereco = [];
    }
} else {
    header("Location: ../index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuário</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style/styleeditar.css">
</head>

<body>
    <h1>Editar usuário</h1>
    <form method="POST" action="editar_action.php">
        <input type="hidden" name="id" value="<?= $cliente['id']; ?>" />
        <label>
            Nome: <input type="text" name="nome" value="<?= $cliente['nome']; ?>" />
        </label>
        <label>
            Data de nascimento: <input type="date" name="datanascimento" value="<?= $cliente['datanascimento']; ?>" />
        </label>
        <label>
            CPF: <input type="text" name="cpf" value="<?= $cliente['cpf']; ?>" />
        </label>
        <label>
            RG: <input type="text" name="rg" value="<?= $cliente['rg']; ?>" />
        </label>
        <label>
            Telefone: <input type="text" name="telefone" value="<?= $cliente['telefone']; ?>" />
        </label>
        <label>
            E-mail: <input type="email" name="email" value="<?= $cliente['email']; ?>" />
        </label>
        <h2>Endereço</h2>
        <label>
            Rua: <input type="text" name="rua" value="<?= $endereco['rua'] ?? ''; ?>" />
        </label>
        <label>
            Cidade: <input type="text" name="cidade" value="<?= $endereco['cidade'] ?? ''; ?>" />
        </label>
        <label>
            Estado: <input type="text" name="estado" value="<?= $endereco['estado'] ?? ''; ?>" />
        </label>
        <label>
            CEP: <input type="text" name="cep" value="<?= $endereco['cep'] ?? ''; ?>" />
        </label>

        <input type="submit" value="Salvar atualização" />
        <a href="../index.php"><input class="bttn-style" type="button" value="Voltar" /></a>

    </form>

</body>

</html>