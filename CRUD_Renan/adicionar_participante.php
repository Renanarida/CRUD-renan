<?php

    include 'conexao.php';
    $id_reuniao = $_GET['id'];

    if ($_POST) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $conn->query("INSERT INTO participantes (nome, email, id_reuniao)
                    VALUES ('$nome', '$email', $id_reuniao)");
        header("Location: participantes.php?id=$id_reuniao");
    }
?>


<h2>Adicionar Participante</h2>
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Telefone: <input type="number" name="nome" required><br>
    E-mail: <<input type="email" name="email" required><br>
    Setor: <input type="text" name="setor" required><br> 
    <input type="submit" value="Adicionar">
</form>