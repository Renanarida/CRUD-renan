<?php
include 'conexao.php';

$hoje = date('Y-m-d');
$result = $conn->query("SELECT * FROM reunioes ORDER BY data, hora");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introdução</title>

    <style>

    .box-reuniao {
        background-color: blue;
        display: flex;
        text-align: center;
        flex-direction:column;
        flex-wrap: nowrap;
        align-content: space-around;
        justify-content: space-around;
        align-items:center
        width: 80vh;
        height: 60vh;
    }

    h2 {
        color: white;
    }

    a {
        color: white;
    }

    </style>

</head>
<body>
    
    <div class="box-reuniao">
        <h2>Reuniões</h2>
        <a href="cadastrar_reuniao.php">Cadastrar nova reunião</a><br><br>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div>
                <strong><?= $row['assunto'] ?></strong> - <?= $row['data'] ?> <?= $row['hora'] ?> <br>
                Local: <?= $row['local'] ?><br>
                <a href="editar_reuniao.php?id=<?= $row['id'] ?>">Editar</a> |
                <a href="excluir_reuniao.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir reunião?')">Excluir</a> |
                <a href="participantes.php?id=<?= $row['id'] ?>">Participantes</a>
            </div>
            <hr>
        <?php endwhile; ?>
    </div>
</body>
</html>
