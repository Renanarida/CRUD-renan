<?php

    include 'conexao.php';
    $id = $_GET['id'];
    $conn->query("DELETE FROM reunioes WHERE id=$id");
    header("Location: index.php");

?>