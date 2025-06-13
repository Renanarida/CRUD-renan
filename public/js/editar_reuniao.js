var modalEditar = document.getElementById('modalEditarReuniao');

  modalEditar.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // botão que acionou o modal
    
    // Pegando os dados do botão
    var id = button.getAttribute('data-reuniao-id');
    var data = button.getAttribute('data-reuniao-data');
    var hora = button.getAttribute('data-reuniao-hora');
    var local = button.getAttribute('data-reuniao-local');
    var assunto = button.getAttribute('data-reuniao-assunto');
    
    // Atualizando os campos do modal
    modalEditar.querySelector('#editId').value = id;
    modalEditar.querySelector('#editData').value = data;
    modalEditar.querySelector('#editHora').value = hora;
    modalEditar.querySelector('#editLocal').value = local;
    modalEditar.querySelector('#editAssunto').value = assunto;
    
    // Atualize a ação do form para enviar o id corretamente, se quiser:
    modalEditar.querySelector('#formEditarReuniao').action = './src/edit_reuniao.php';  });