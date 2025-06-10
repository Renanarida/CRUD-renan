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
        include_once'adicionar_participante.php';
        ?>
        <div class="container mt-4">
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Pesquisar reuniões...">
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="cardsContainer">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col card-item">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['assunto']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?= htmlspecialchars($row['data']) ?> às <?= htmlspecialchars($row['hora']) ?>
                            </h6>
                            <p class="card-text"><strong>Local:</strong> <?= htmlspecialchars($row['local']) ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalEditarReuniao" data-reuniao-id="<?= $row['id'] ?>"
                                data-reuniao-data="<?= htmlspecialchars($row['data']) ?>"
                                data-reuniao-hora="<?= htmlspecialchars($row['hora']) ?>"
                                data-reuniao-local="<?= htmlspecialchars($row['local']) ?>"
                                data-reuniao-assunto="<?= htmlspecialchars($row['assunto']) ?>">
                                Editar Reunião
                            </button>
                            <a class="btn btn-danger btn-sm" href="excluir_reuniao.php?id=<?= $row['id'] ?>"
                                onclick="return confirm('Excluir reunião?')">Excluir</a>
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                data-bs-target="#modalParticipantes" data-id="<?= $row['id'] ?>">
                                Participantes
                            </button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>


            <script>
            const searchInput = document.getElementById('searchInput');
            const cardsContainer = document.getElementById('cardsContainer');
            const cards = cardsContainer.getElementsByClassName('card-item');

            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();

                for (let card of cards) {
                    const assunto = card.querySelector('.card-title').textContent.toLowerCase();
                    const local = card.querySelector('.card-text').textContent.toLowerCase();
                    const dataHora = card.querySelector('.card-subtitle').textContent.toLowerCase();

                    if (assunto.includes(filter) || local.includes(filter) || dataHora.includes(filter)) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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