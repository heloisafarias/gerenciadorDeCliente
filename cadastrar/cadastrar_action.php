<?php

require '../config.php';

$nome = filter_input(INPUT_POST, 'nome');
$datanascimento = filter_input(INPUT_POST, 'datanascimento');
$cpf = filter_input(INPUT_POST, 'cpf');
$rg = filter_input(INPUT_POST, 'rg');
$telefone = filter_input(INPUT_POST, 'telefone');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

$ruas = $_POST['rua'];
$cidades = $_POST['cidade'];
$estados = $_POST['estado'];
$ceps = $_POST['cep'];

if (!$nome || !$datanascimento || !$cpf || !$rg || !$telefone || !$email || empty($ruas) || empty($cidades) || empty($estados) || empty($ceps)) {
    header("Location: cadastrar.php");
    exit;
}

$sql = $pdo->prepare("INSERT INTO clientes (nome, datanascimento, cpf, rg, telefone, email) VALUES (:nome, :datanascimento, :cpf, :rg, :telefone, :email)");
$sql->bindValue(':nome', $nome);
$sql->bindValue(':datanascimento', $datanascimento);
$sql->bindValue(':cpf', $cpf);
$sql->bindValue(':rg', $rg);
$sql->bindValue(':telefone', $telefone);
$sql->bindValue(':email', $email);
$sql->execute();

$cliente_id = $pdo->lastInsertId();

for ($i = 0; $i < count($ruas); $i++) {
    $sql = $pdo->prepare("INSERT INTO endereco (cliente_id, rua, cidade, estado, cep) VALUES (:cliente_id, :rua, :cidade, :estado, :cep)");
    $sql->bindValue(':cliente_id', $cliente_id);
    $sql->bindValue(':rua', $ruas[$i]);
    $sql->bindValue(':cidade', $cidades[$i]);
    $sql->bindValue(':estado', $estados[$i]);
    $sql->bindValue(':cep', $ceps[$i]);
    $sql->execute();
}

header("Location: ../index.php");
exit;
