<span class="d-none d-md-block">

    @can('guest-list')
        <style>
            .disabled-link {
            pointer-events: none;
            }
        </style>
        @if ($guest->status != "Pendente")  {{-- $key % 2 == 0 --}}

            <a href="{{ route('guests.register', $guest->id) }}" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#exampleModal2<?= $guest->id;?>">Registrar</a>
                                                                
        @elseif ($guest->status == "Pendente") 
        
            <a href="{{ route('guests.register', $guest->id) }}" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="">Registrar</a>
                
        @endif

    @endcan

    @can('guest-list')
        <a href="{{ route('guests.history', $guest->id) }}" class="btn btn-outline-primary btn-sm">Ver Histórico</a>
    @endcan

    @can('guest-edit')
        <a hidden href="{{ route('guests.edit', $guest->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
    @endcan

</span>
<div class="dropdown d-block d-md-none">
    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ações
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
        <a href="{{ route('guests.show', $guest->id) }}" class="dropdown-item">Visualizar</a>
        @can('guest-edit')
            <a href="{{ route('guests.edit', $guest->id) }}" class="dropdown-item">Editar</a>
        @endcan
        @can('guest-delete')
            <button class="dropdown-item" onclick="return confirm('Deseja apagar o usuário ?')">Apagar</button>
        @endcan
    </div>
</div>