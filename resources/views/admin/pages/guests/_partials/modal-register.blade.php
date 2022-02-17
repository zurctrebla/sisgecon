
<div class="modal fade" id="exampleModal2<?= $guest->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModal2Title">Visitante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('guests.register', $guest->id) }}" style="display:inline" method="GET">
                @csrf

                <div>
                    Registrar Visitante <strong>{{$guest->name}}</strong> em {{date('d/m/Y H:i:s')}} ?
                </div>

                @if ($key >= 3)
                <div>
                    Visitante já possui todos os registros do dia.<br>
                    Precisa justificar novo registro.
                </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Motivo *</label>
                                <input type="text" name="reason" class="form-control" placeholder="Motivo" min="5" max="200" required>
                            </div>
                        </div>
                    </div>
                @endif

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
            </form>
    </div>
    </div>
</div>