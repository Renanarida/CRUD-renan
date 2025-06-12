               //cria consts com os elementos dos cards das reuniões 
            const searchInput = document.getElementById('searchInput');
            const cardsContainer = document.getElementById('cardsContainer');
            const cards = cardsContainer.getElementsByClassName('card-item');

            // Adiciona o evento de input no campo de pesquisa
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

                fetch('./add/adicionar_participante.php', {
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
                            fetch('./private/carregar_participantes.php?id=' + id)
                                .then(res => res.text())
                                .then(html => {
                                    document.getElementById('modalParticipantesBody').innerHTML = html;
                                });
                        } else {
                            alert("Erro ao adicionar participante.");
                        }
                    });
            });
