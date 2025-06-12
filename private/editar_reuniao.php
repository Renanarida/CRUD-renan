
<div class="modal fade" id="modalEditarReuniao" tabindex="-1" aria-labelledby="modalEditarReuniaoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form method="post" id="formEditarReuniao" action="./edit/edit_reuniao.php">
        <input type="hidden" name="edit-reuniao" value="1">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarReuniaoLabel">Editar Reunião</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="editId" value="">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="data" class="form-label">Data</label>
              <input type="date" class="form-control" name="data" id="editData" required
                value="">
            </div>
            <div class="col-md-6">
              <label for="hora" class="form-label">Hora</label>
              <input type="time" class="form-control" name="hora" id="editHora" required
                value="">
            </div>
            <div class="col-md-12">
              <label for="local" class="form-label">Local</label>
              <input type="text" class="form-control" name="local" id="editLocal"
                value="">
            </div>
            <div class="col-md-12">
              <label for="assunto" class="form-label">Assunto</label>
              <input type="text" class="form-control" name="assunto" id="editAssunto" required
                value="">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="editar_reuniao.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>