@extends('adminlte::page')

@section('title', 'Editar Setor')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <span class="d-none d-md-block">
                    <a href="{{ route('sectors.index') }}" class="btn btn-outline-info btn-sm">Listar</a>
                    @can('sector-show')
                        <a href="{{ route('sectors.show', $sector->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
                    @endcan
                    @can('sector-delete')
                        <form action="{{ route('sectors.destroy', $sector->id) }}" style="display:inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o setor ?')" >Apagar</button>
                        </form>
                    @endcan
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu" aria-labelledby="acoesListar">
                        <a href="{{ route('sectors.show', $sector->id) }}" class="dropdown-item">Listar</a>
                        @can('sector-edit')
                            <a href="{{ route('sectors.edit', $sector->id) }}" class="dropdown-item">Editar</a>
                        @endcan
                        @can('sector-delete')
                            <button class="dropdown-item" onclick="return confirm('Deseja apagar o setor ?')">Apagar</button>
                        @endcan
                    </div>
                </div>
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
                <h3 class="card-title">Editar Setor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('sectors.update', $destiny->id) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.sectors._partials.form')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
