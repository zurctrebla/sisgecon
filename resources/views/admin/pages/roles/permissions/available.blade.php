@extends('adminlte::page')

@section('title', 'Nível de Acesso')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Permissões disponíveis <strong>{{ $role->name }}</strong></h3>
            </div>
            <div hidden class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{-- {{ route('roles.permissions.available', $role->id) }} --}}" class="btn btn-outline-success btn-sm">Cadastrar</a>
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
                        <form action="{{ route('roles.permissions.available', $role->id) }}" method="POST" class="form form-inline">
                            @csrf
                            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="btn btn-dark">Filtrar</button>
                        </form>
                    </div>
                        <div class="card-body">
                            <table id="roles" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('roles.permissions.attach', $role->id) }}" method="POST">
                                        @csrf

                                        @foreach ($permissions as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                                </td>
                                                <td>
                                                    {{ $permission->name }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="500">
                                                @include('admin.includes.alerts')

                                                <button type="submit" class="btn btn-outline-success btn-sm">Vincular</button>
                                            </td>
                                        </tr>
                                    </form>
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
