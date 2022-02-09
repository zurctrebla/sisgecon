@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <span class="d-none d-md-block">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-info btn-sm">Listar</a>
                    @can('user-show')
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
                    @endcan
                    @can('user-delete')
                        <form action="{{ route('users.destroy', $user->id) }}" style="display:inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o usuário ?')" >Apagar</button>
                        </form>
                    @endcan
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-sm">Listar</a>
                        @can('user-edit')
                            <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">Editar</a>
                        @endcan
                        @can('user-delete')
                            <button class="dropdown-item" onclick="return confirm('Deseja apagar o usuário ?')">Apagar</button>
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
                <h3 class="card-title">Editar Usuário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.users._partials.form')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
