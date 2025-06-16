<?php

    require_once __DIR__ . '/../../config/conexao.php';

    $id = $_GET['id'] ?? null;
    $reuniao = $_GET['reuniao'] ?? null;

    $conn->query("DELETE FROM participantes WHERE id = $id");
    header("Location: ./../reunioes.php?id=$id_reuniao");
?>