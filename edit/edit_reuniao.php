<?php
include __DIR__ . '/../conexao.php';



if ($_POST && isset($_POST['edit-reuniao'])) {
    $id = $_POST['id'] ?? null;
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $local = $_POST['local'] ?? '';
    $assunto = $_POST['assunto'] ?? '';

    if ($id) {
        $conn->query("UPDATE reunioes SET data='$data', hora='$hora', local='$local', assunto='$assunto' WHERE id=$id"); 
        header("Location: ./../index.php");
        exit;
    }
}
?>