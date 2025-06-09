<?php
include 'conexao.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

$reuniao = $conn->query("SELECT * FROM reunioes WHERE id=$id")->fetch_assoc();
$participantes = $conn->query("SELECT * FROM participantes WHERE id_reuniao=$id");

if (!$reuniao) {
    echo "<p>Reunião não encontrada.</p>";
    exit;
}

echo "<h5>Participantes da reunião: " . htmlspecialchars($reuniao['assunto']) . "</h5>";
echo '<a href="adicionar_participante.php?id=' . $id . '" class="btn btn-success btn-sm mb-2">Adicionar Participante</a>';

if ($participantes->num_rows > 0) {
    echo "<ul class='list-group'>";
    while ($p = $participantes->fetch_assoc()) {
        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
        echo htmlspecialchars($p['nome']) . " (" . htmlspecialchars($p['email']) . ")";
        echo '<a href="remover_participante.php?id=' . $p['id'] . '&reuniao=' . $id . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Remover participante?\')">Remover</a>';
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Nenhum participante cadastrado.</p>";
}
?>
