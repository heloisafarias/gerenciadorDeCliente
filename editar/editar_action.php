<?php
require '../config.php';

$id = filter_input(INPUT_POST, 'id');
$nome = filter_input(INPUT_POST, 'nome');
$datanascimento = filter_input(INPUT_POST, 'datanascimento');
$cpf = filter_input(INPUT_POST, 'cpf');
$rg = filter_input(INPUT_POST, 'rg');
$telefone = filter_input(INPUT_POST, 'telefone');
$email = filter_input(INPUT_POST, 'email');
$rua = filter_input(INPUT_POST, 'rua');
$cidade = filter_input(INPUT_POST, 'cidade');
$estado = filter_input(INPUT_POST, 'estado');
$cep = filter_input(INPUT_POST, 'cep');

if (!$id || !$nome || !$datanascimento || !$cpf || !$rg || !$telefone || !$email || !$rua || !$cidade || !$estado || !$cep) {
    header("Location: ../cadastrar/cadastrar.php");
    exit;
}

$sql_cliente = $pdo->prepare("UPDATE clientes SET nome = :nome, datanascimento = :datanascimento, cpf = :cpf, rg = :rg, telefone = :telefone, email = :email WHERE id = :id");
$sql_cliente->bindValue(':id', $id);
$sql_cliente->bindValue(':nome', $nome);
$sql_cliente->bindValue(':datanascimento', $datanascimento);
$sql_cliente->bindValue(':cpf', $cpf);
$sql_cliente->bindValue(':rg', $rg);
$sql_cliente->bindValue(':telefone', $telefone);
$sql_cliente->bindValue(':email', $email);
$sql_cliente->execute();

$sql_endereco = $pdo->prepare("SELECT * FROM endereco WHERE cliente_id = :id");
$sql_endereco->bindValue(':id', $id);
$sql_endereco->execute();

if ($sql_endereco->rowCount() > 0) {

    $sql_update_endereco = $pdo->prepare("UPDATE endereco SET rua = :rua, cidade = :cidade, estado = :estado, cep = :cep WHERE cliente_id = :id");
} else {

    $sql_update_endereco = $pdo->prepare("INSERT INTO endereco (cliente_id, rua, cidade, estado, cep) VALUES (:id, :rua, :cidade, :estado, :cep)");
}

$sql_update_endereco->bindValue(':id', $id);
$sql_update_endereco->bindValue(':rua', $rua);
$sql_update_endereco->bindValue(':cidade', $cidade);
$sql_update_endereco->bindValue(':estado', $estado);
$sql_update_endereco->bindValue(':cep', $cep);
$sql_update_endereco->execute();

header("Location: ../index.php");
exit;
