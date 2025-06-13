var modalParticipantes = document.getElementById('modalParticipantes');

modalParticipantes.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');

    // Preenche o campo hidden com o id da reunião
    modalParticipantes.querySelector('#id_reuniao').value = id;

    // Carrega participantes via AJAX
    var modalBody = modalParticipantes.querySelector('#modalParticipantesBody');
    modalBody.innerHTML = 'Carregando...';

    fetch('./src/carregar_participantes.php?id=' + id)
        .then(response => response.text())
        .then(html => {
            modalBody.innerHTML = html;
        })
        .catch(error => {
            modalBody.innerHTML = '<p class="text-danger">Erro ao carregar participantes.</p>';
        });
});