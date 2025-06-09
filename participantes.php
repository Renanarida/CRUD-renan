<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modal Bootstrap com PHP</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <?php
include 'conexao.php';
$id_reuniao = $_GET['id'] ?? 0;

// Buscar dados da reunião
$reuniao = $conn->query("SELECT * FROM reunioes WHERE id=$id_reuniao")->fetch_assoc();

// Buscar os participantes
$participantes = $conn->query("SELECT * FROM participantes WHERE id_reuniao=$id_reuniao");
?>

    <!-- Botão para abrir modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalParticipantes">
        Ver Participantes da reunião: <?= htmlspecialchars($reuniao['assunto']) ?>
    </button>

    <!-- Modal Participantes -->
    <div class="modal fade" id="modalParticipantes" tabindex="-1" aria-labelledby="modalParticipantesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalParticipantesLabel">Participantes da reunião:
                        <?= htmlspecialchars($reuniao['assunto']) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>
                    <button class="btn btn-success btn-sm mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalAddParticipante" data-reuniao-id="<?= $id ?>">
                        Adicionar Participante
                    </button>

                    <div>
                        <?php if ($participantes->num_rows > 0): ?>
                        <ul class="list-group">
                            <?php while ($p = $participantes->fetch_assoc()): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($p['nome']) ?> (<?= htmlspecialchars($p['email']) ?>)
                                <a href="remover_participante.php?id=<?= $p['id'] ?>&reuniao=<?= $id_reuniao ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza que deseja remover este participante?')">
                                    Remover
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php else: ?>
                        <p>Nenhum participante cadastrado para esta reunião.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>