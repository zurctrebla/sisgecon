<div class="modal fade" id="exampleModalCenter<?= $guest->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Visitante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('guests.update', $guest->id) }}" style="display:inline" method="POST">
                @csrf
                @method('PUT')
                <select name="status" class="form-control">
                    <option value="">Escolha...</option>
                    <option value="Autorizado">Autorizar Acesso</option>
                    <option value="Bloqueado">Bloquear Acesso</option>
                </select>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
            </form>
    </div>
    </div>
</div>