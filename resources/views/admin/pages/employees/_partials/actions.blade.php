<span class="d-none d-md-block">
    <a hidden href="{{ route('guests.show', $employee->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
    @can('employee-edit')
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
    @endcan
    @can('employee-delete')
        <form hidden action="{{ route('employees.destroy', $employee->id) }}" style="display:inline" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o visitante ?')" >Apagar</button>
        </form>
    @endcan
</span>
<div class="dropdown d-block d-md-none">
    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
        <a href="{{ route('employees.show', $employee->id) }}" class="dropdown-item">Visualizar</a>
        @can('employee-edit')
            <a href="{{ route('employees.edit', $employee->id) }}" class="dropdown-item">Editar</a>
        @endcan
        @can('employee-delete')
            <button class="dropdown-item" onclick="return confirm('Deseja apagar o visitante ?')">Apagar</button>
        @endcan
    </div>
</div>
