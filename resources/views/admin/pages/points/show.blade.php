@extends('adminlte::page')

@section('title', 'Nível de Acesso')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3>Visualizar</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <span class="d-none d-md-block">
                <a href="{{ route('roles.index') }}" class="btn btn-outline-info btn-sm">Listar</a>
                @can('role-edit')
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                @endcan
                @can('role-delete')
                <form action="{{ route('roles.destroy', $role->id) }}" style="display:inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o nível de acesso?')" >Apagar</button>
                </form>
                @endcan
            </span>
            <div class="dropdown d-block d-md-none">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-outline-info btn-sm">Listar</a>
                    @can('role-edit')
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                    @endcan
                    @can('role-delete')
                        <button class="dropdown-item" onclick="return confirm('Deseja apagar o nível de acesso?')">Apagar</button>
                    @endcan
                </div>
            </div>
        </ol>
      </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Visualizar</h3>
          </div>
          <div class="card-body">
            <div class="column-responsive column-80">
                <div class="inputs view content">
                    <table>
                        <tr>
                            <th><?= __('Nome') ?></th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Permissões') ?></th>
                            @if(!empty($role->permissions))
                                @foreach($role->permissions as $permission)
                                    <td><label class="badge badge-success">{{ $permission->name }}</label></td>
                                @endforeach
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection
