<?php

    include 'conexao.php';
    $id = $_GET['id'];
    $id_reuniao = $_GET['reuniao'];

    $conn->query("DELETE FROM participantes WHERE id=$id");
    header("Location: participantes.php?id=$id_reuniao");
?>