@extends('adminlte::page')

@section('title', 'Setores')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Listar</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @can('sectors-create')
                    <a href="{{ route('sectors.create') }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
                @endcan
            </ol>
            </div>
        </div>
    </div>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <form action="{{ route('sectors.search') }}" method="POST" class="form form-inline">
                            @csrf
                            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="btn btn-dark">Filtrar</button>
                        </form>
                    </div>
                        <div class="card-body">
                            <table id="sectors" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sectors as $sector)
                                        <tr>
                                            <td>{{ $sector->name }}</td>
                                            <td class="text-center">
                                                <span class="d-none d-md-block">
                                                    @can('sector-list')
                                                        <a href="{{ route('sectors.show', $sector->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                                    @endcan
                                                    @can('sector-edit')
                                                        <a href="{{ route('sectors.edit', $sector->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                                                    @endcan
                                                    @can('sector-delete')
                                                        <form action="{{ route('sectors.destroy', $sector->id) }}" style="display:inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o setor?')" >Apagar</button>
                                                        </form>
                                                    @endcan
                                                </span>
                                                <div class="dropdown d-block d-md-none">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                        <a href="{{ route('sectors.show', $sector->id) }}" class="dropdown-item">Visualizar</a>
                                                        @can('sector-edit')
                                                            <a href="{{ route('sectors.edit', $sector->id) }}" class="dropdown-item">Editar</a>
                                                        @endcan
                                                        @can('sector-delete')
                                                            <button class="dropdown-item" onclick="return confirm('Deseja apagar o setor?')">Apagar</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            @if (isset($filters))
                                {!! $sectors->appends($filters)->links() !!}
                            @else
                                {!! $sectors->links() !!}
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop
