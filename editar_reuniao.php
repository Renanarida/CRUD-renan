<?php
include 'conexao.php';
$id = $_GET['id'];

if ($_POST) {
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $local = $_POST['local'];
    $assunto = $_POST['assunto'];
    $conn->query("UPDATE reunioes SET data='$data', hora='$hora', local='$local', assunto='$assunto' WHERE id=$id");
    header("Location: index.php");
}

$reuniao = $conn->query("SELECT * FROM reunioes WHERE id=$id")->fetch_assoc();
?>

<h2>Editar Reunião</h2>
<form method="post">
    Data: <input type="date" name="data" value="<?= $reuniao['data'] ?>"><br>
    Hora: <input type="time" name="hora" value="<?= $reuniao['hora'] ?>"><br>
    Local: <input type="text" name="local" value="<?= $reuniao['local'] ?>"><br>
    Assunto: <input type="text" name="assunto" value="<?= $reuniao['assunto'] ?>"><br>
    <input type="submit" value="Atualizar">
</form>
