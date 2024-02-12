<?php
require '../config.php';

$id = filter_input(INPUT_GET, 'id');

if ($id) {
if ($id) {

    $sql = $pdo->prepare("DELETE FROM endereco WHERE cliente_id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
    $sql = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();
}
}

header("Location: ../index.php");
header("Location: ../index.php");
exit;

?>