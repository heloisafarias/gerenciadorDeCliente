<?php
require 'config.php';

$lista = [];
$sql = $pdo->query("SELECT c.*, e.rua, e.cidade, e.estado, e.cep FROM clientes c LEFT JOIN endereco e ON c.id = e.cliente_id");
if ($sql->rowCount() > 0) {
    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}

session_start();

if (isset($_SESSION['name'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_destroy();
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Usuários</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/styleindex.css">
</head>

<body>

    <div class="container">
        <h1>Listagem de Usuários</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input class="btn-style" type="submit" name="logout" value="Sign out" />
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data de nascimento</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Rua</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($lista as $usuario) : ?>
                <tr>
                    <td><?= $usuario['id']; ?></td>
                    <td><?= $usuario['nome']; ?></td>
                    <td><?= $usuario['datanascimento']; ?></td>
                    <td><?= $usuario['cpf']; ?></td>
                    <td><?= $usuario['rg']; ?></td>
                    <td><?= $usuario['telefone']; ?></td>
                    <td><?= $usuario['email']; ?></td>
                    <td><?= $usuario['rua']; ?></td>
                    <td><?= $usuario['cidade']; ?></td>
                    <td><?= $usuario['estado']; ?></td>
                    <td><?= $usuario['cep']; ?></td>
                    <td><a href="editar/editar.php?id=<?= $usuario['id']; ?>" class="btn-style">Editar</a>
                        <a href="excluir/excluir.php?id=<?= $usuario['id']; ?>" class="btn-style">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <a href="cadastrar/cadastrar.php" class="btn-style">Cadastrar novo usuário</a>

    </div>

</body>

</html>