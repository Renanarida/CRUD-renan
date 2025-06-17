document.addEventListener('DOMContentLoaded', function() {
    var modalEditar = document.getElementById('modalEditarParticipante');

    modalEditar.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        var id = button.getAttribute('data-id');
        var nome = button.getAttribute('data-nome');
        var email = button.getAttribute('data-email');
        var telefone = button.getAttribute('data-telefone');
        var setor = button.getAttribute('data-setor');

        // Preenchendo o formulário do modal
        modalEditar.querySelector('#editar_id_participante').value = id;
        modalEditar.querySelector('#editar_nome').value = nome;
        modalEditar.querySelector('#editar_email').value = email;
        modalEditar.querySelector('#editar_telefone').value = telefone;
        modalEditar.querySelector('#editar_setor').value = setor;
    });
});