<span class="d-none d-md-block">

    {{-- @can('employees-register') --}}
        <a href="{{ route('employees.register', $employee->id) }}" class="btn btn-outline-<?php if ($key % 2 == 0){ echo "dark"; }else{ echo "danger"; } ?> btn-sm" data-toggle="modal" data-target="#exampleModalCenter<?= $employee->id;?>">Registrar</a>
    {{-- @endcan --}}

    {{-- @can('employees-history') --}}
        <a href="{{ route('employees.history', $employee->id) }}" class="btn btn-outline-primary btn-sm">Ver Histórico</a>
    {{-- @endcan --}}

    @can('employee-edit')
        <a hidden href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
    @endcan

</span>
<div class="dropdown d-block d-md-none">
    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
        @can('employee-edit')
        <div hidden>
            <a hidden href="{{ route('employees.show', $employee->id) }}" class="dropdown-item">Visualizar</a>

        </div>
        @endcan
        @can('employee-edit')
            <a href="{{ route('employees.edit', $employee->id) }}" class="dropdown-item">Editar</a>
        @endcan
        @can('employee-delete')
        <div hidden >
            <button hidden class="dropdown-item" onclick="return confirm('Deseja apagar o usuário ?')">Apagar</button>

        </div>
        @endcan
    </div>
</div>
