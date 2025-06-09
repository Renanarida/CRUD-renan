<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_participante'])) {
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

<!-- Modal Participantes -->
<div class="modal fade" id="modalParticipantes" tabindex="-1" aria-labelledby="modalParticipantesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalParticipantesLabel">Adicionar Participante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <!-- Formulário dentro do modal -->
                <form name="post_participante" method="POST">   <------ajustar---------->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="setor" class="form-label">Setor</label>
                            <input type="text" name="setor" class="form-control" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Adicionar Participante</button>
                    </div>
                </form>

                <hr>

                <!-- Lista de participantes carregada via JS -->
                <div id="modalParticipantesBody">
                    Carregando...
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>

        </div>
    </div>
</div>

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
