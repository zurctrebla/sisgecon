
{{-- modal --}}
    <div class="modal fade" id="exampleModal{{ $dado[$i]->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalTitle">Editar Hora</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('points.update', $dado[$i]->id) }}" style="display:inline" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="time" name="hora_ocorrencia" id="{{ $dado[$i]->id }}" value="{{ $dado[$i]->hora_ocorrencia ?? old('hora_ocorrencia') }}" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-warning">Editar</button>
            </div>
                </form>
        </div>
        </div>
    </div>
{{-- modal --}}
