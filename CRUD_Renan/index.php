<?php
include 'conexao.php';

$hoje = date('Y-m-d');
$result = $conn->query("SELECT * FROM reunioes ORDER BY data, hora");
?>

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
