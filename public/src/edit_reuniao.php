<?php
require_once __DIR__ . '/../../config/conexao.php';



if ($_POST && isset($_POST['edit-reuniao'])) {
    $id = $_POST['id'] ?? null;
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $local = $_POST['local'] ?? '';
    $assunto = $_POST['assunto'] ?? '';

    if ($id) {
        $conn->query("UPDATE reunioes SET data='$data', hora='$hora', local='$local', assunto='$assunto' WHERE id=$id"); 
        header("Location: /CRUD_renan/public/reunioes.php");
        exit;
    }
}
?>