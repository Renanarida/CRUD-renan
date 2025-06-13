<?php

    require_once __DIR__ . '/../../config/conexao.php';
    $id = $_GET['id'];
    $conn->query("DELETE FROM reunioes WHERE id=$id");
    header("Location: ../reunioes.php");

?>