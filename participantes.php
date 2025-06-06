<?php
include 'conexao.php';
$id_reuniao = $_GET['id'];

// Buscar dados da reunião
$reuniao = $conn->query("SELECT * FROM reunioes WHERE id=$id_reuniao")->fetch_assoc();

// Buscar os participantes
$participantes = $conn->query("SELECT * FROM participantes WHERE id_reuniao=$id_reuniao");
?>

<h2>Participantes da reunião: <?= $reuniao['assunto'] ?></h2>

<a href="index.php">Voltar</a>
<a href="adicionar_participante.php?id=<?= $id_reuniao ?>">Adicionar Participante</a>

<br><br>

<?php while ($p = $participantes->fetch_assoc()): ?>
    <?= $p['nome'] ?> (<?= $p['email'] ?>) -
    <a href="remover_participante.php?id=<?= $p['id'] ?>&reuniao=<?= $id_reuniao ?>">Remover</a><br>
<?php endwhile; ?>