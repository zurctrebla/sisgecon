@extends('adminlte::page')

@section('title', 'Nível de Acesso')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Permissões <strong>{{ $role->name }}</strong></h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{ route('roles.permissions.available', $role->id) }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
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
                    <h3 class="card-title">Listar</h3>
                    </div>
                        <div class="card-body">
                            <table id="roles" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>
                                                {{ $permission->name }}
                                            </td>
                                            <td class="text-center">
                                                <span class="d-none d-md-block">
                                                    <a href="{{ route('roles.permission.detach', [$role->id, $permission->id]) }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja desvincular o nível de acesso?')">Desvincular</a>
                                                </span>
                                                <div class="dropdown d-block d-md-none">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                        <a href="{{ route('roles.permission.detach', [$role->id, $permission->id]) }}}" class="dropdown-item" onclick="return confirm('Deseja desvincular o nível de acesso?')">Desvincular</a>
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
                                {!! $permissions->appends($filters)->links() !!}
                            @else
                                {!! $permissions->links() !!}
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop
