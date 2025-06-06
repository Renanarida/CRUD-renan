<?php

    //insere o conteudo em outro arquivo PHP
    include 'conexao.php';

    if ($_POST) {
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $local = $_POST['local'];
        $assunto = $_POST['assunto'];

    $conn->query("INSERT INTO reunioes (data, hora, local, assunto)
            VALUES ('$data', '$hora', '$local', '$assunto')");
    header("Location: index.php");
    }
?>

<h2>Cadastrar Reunião</h2>
<form method="post">
    Data: <input type="date" name="data" required><br>
    Hora: <input type="time" name="hora" required><br>
    Local: <input type="text" name="local"><br>
    Assunto: <input type="text" name="assunto" required><br>
    <input type="submit" value="Salvar">

</form>