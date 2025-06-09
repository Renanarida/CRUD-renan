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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title>Introdução</title>

    <style>
    .box-reuniao {
        background-color: rgb(5, 10, 163);
        display: flex;
        text-align: center;
        flex-direction: column;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: center;
        align-items: center width: 80vh;
        height: 100vh;
    }
/* 
    .body-box {
        width: 100vh;
    } */

    h2 {
        color: white;
    }
    </style>

</head>

<body class="body-box">

    <div class="box-reuniao">
        <h2>Reuniões</h2>
        <!-- Botão para abrir o modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddReuniao">
            Cadastrar Reunião
        </button>
        <?php
        include_once'cadastrar_reuniao.php';
        include_once'editar_reuniao.php';
        ?>
        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['assunto']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?= htmlspecialchars($row['data']) ?> às <?= htmlspecialchars($row['hora']) ?>
                            </h6>
                            <p class="card-text"><strong>Local:</strong> <?= htmlspecialchars($row['local']) ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <!-- Botão para abrir modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalEditarReuniao" data-reuniao-id="<?= $row['id'] ?>"
                                data-reuniao-data="<?= htmlspecialchars($row['data']) ?>"
                                data-reuniao-hora="<?= htmlspecialchars($row['hora']) ?>"
                                data-reuniao-local="<?= htmlspecialchars($row['local']) ?>"
                                data-reuniao-assunto="<?= htmlspecialchars($row['assunto']) ?>">
                                Editar Reunião
                            </button>

                            <a href="excluir_reuniao.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Excluir reunião?')" class="card-link text-danger">Excluir</a>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#modalParticipantes" data-id="<?= $row['id'] ?>">
                                Participantes
                            </button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <!-- Modal Participantes -->
            <div class="modal fade" id="modalParticipantes" tabindex="-1" aria-labelledby="modalParticipantesLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="modalParticipantesLabel">Participantes</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Fechar"></button>
                        </div>

                        <div class="modal-body" id="modalParticipantesBody">
                            Carregando...
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal Adicionar Participante -->
            <div class="modal fade" id="modalAddParticipante" tabindex="-1" aria-labelledby="modalAddParticipanteLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="formAddParticipante" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAddParticipanteLabel">Adicionar Participante</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_reuniao" id="addParticipanteReuniaoId" value="">

                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nome" required>
                                </div>

                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="number" class="form-control" name="telefone" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="setor" class="form-label">Setor</label>
                                    <input type="text" class="form-control" name="setor" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        var modalParticipantes = document.getElementById('modalParticipantes');

        modalParticipantes.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');

            var modalBody = modalParticipantes.querySelector('#modalParticipantesBody');
            modalBody.innerHTML = 'Carregando...';

            fetch('carregar_participantes.php?id=' + id)
                .then(response => response.text())
                .then(html => {
                    modalBody.innerHTML = html;
                })
                .catch(error => {
                    modalBody.innerHTML = '<p class="text-danger">Erro ao carregar participantes.</p>';
                });
        });
        </script>

        <script>
        // Quando abrir o modal de adicionar participante, preenche o ID
        var modalAddParticipante = document.getElementById('modalAddParticipante');
        modalAddParticipante.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var idReuniao = button.getAttribute('data-reuniao-id');
            modalAddParticipante.querySelector('#addParticipanteReuniaoId').value = idReuniao;
        });

        // Enviar o formulário via AJAX
        document.getElementById('formAddParticipante').addEventListener('submit', function(e) {
            e.preventDefault();

            var form = e.target;
            var formData = new FormData(form);

            fetch('adicionar_participante.php', {
                    method: 'POST',
                    body: formData
                })
                .then(resp => resp.text())
                .then(result => {
                    if (result.trim() === "ok") {
                        // Fecha o modal
                        var modal = bootstrap.Modal.getInstance(modalAddParticipante);
                        modal.hide();

                        // Atualiza a lista de participantes
                        var id = formData.get('id_reuniao');
                        fetch('carregar_participantes.php?id=' + id)
                            .then(res => res.text())
                            .then(html => {
                                document.getElementById('modalParticipantesBody').innerHTML = html;
                            });
                    } else {
                        alert("Erro ao adicionar participante.");
                    }
                });
        });
        </script>

</body>

</html>