<span class="d-none d-md-block">
    <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
    @can('guest-edit')
        <a href="{{ route('guests.edit', $guest->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
    @endcan
    @can('guest-delete')
        <form action="{{ route('guests.destroy', $guest->id) }}" style="display:inline" method="POST">
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
        <a href="{{ route('guests.show', $guest->id) }}" class="dropdown-item">Visualizar</a>
        @can('guest-edit')
            <a href="{{ route('guests.edit', $guest->id) }}" class="dropdown-item">Editar</a>
        @endcan
        @can('guest-delete')
            <button class="dropdown-item" onclick="return confirm('Deseja apagar o visitante ?')">Apagar</button>
        @endcan
    </div>
</div>