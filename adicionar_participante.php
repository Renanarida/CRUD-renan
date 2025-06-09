<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $setor = $_POST['setor'];
    $id_reuniao = $_POST['id_reuniao'];

    $stmt = $conn->prepare("INSERT INTO participantes (nome, telefone, email, setor, id_reuniao) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $nome, $telefone, $email, $setor, $id_reuniao);

    if ($stmt->execute()) {
        echo "Participante adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar participante: " . $stmt->error;
    }

    $stmt->close();
}
?>

<form method="POST">
    <input type="hidden" name="id_reuniao" value="<?= $_GET['id'] ?>">
    Nome: <input type="text" name="nome" required><br>
    Telefone: <input type="text" name="telefone" required><br>
    E-mail: <input type="email" name="email" required><br>
    Setor: <input type="text" name="setor" required><br>
    <input type="submit" value="Adicionar Participante">
</form>