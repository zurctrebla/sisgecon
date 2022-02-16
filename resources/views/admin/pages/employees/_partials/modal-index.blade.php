
<div class="modal fade" id="exampleModalCenter<?= $employee->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Funcionário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('employees.register', $employee->id) }}" style="display:inline" method="GET">
                @csrf

                <div>
                    Registrar Funcionário <strong>{{$employee->name}}</strong> em {{date('d/m/Y H:i:s')}} ?
                </div>

                @if ($key >= 3)
                <div>
                    Funcionário já possui todos os registros do dia.<br>
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
