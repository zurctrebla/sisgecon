@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Listar</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{ route('users.createEmployee') }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
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
                        <form action="{{ route('users.search') }}" method="POST" class="form form-inline">
                            @csrf
                            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="btn btn-dark">Filtrar</button>
                        </form>
                    </div>
                        <div class="card-body">
                            <table id="users" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Função</th>
                                        <th>Setor</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                {{ $user->employee->function }}
                                            </td>
                                            <td>
                                                {{ $user->employee->sector }}
                                            </td>
                                            <td class="text-center">
                                                <span class="d-none d-md-block">
                                                        <?php

                                                            $t = "info"; $u = "Entrada";

                                                            foreach ($user->sheets as $sheet) {

                                                                if (($sheet->status == "3") OR $sheet->status == "1" ) {

                                                                $t = "dark"; $u = "Saída";

                                                                } else if ($sheet->status == "2") {

                                                                $t = "info"; $u = "Entrada";

                                                                }

                                                            }

                                                        ?>
                                                    <a href="{{ route('users.register', $user->id) }}" class="btn btn-outline-<?= $t ; ?> btn-sm">Registrar <?= $u ; ?></a>
                                                    @can('user-edit')
                                                        <a href="{{ route('users.history', $user->id) }}" class="btn btn-outline-primary btn-sm">Ver Histórico</a>
                                                    @endcan

                                                    @can('user-edit')
                                                        <a hidden href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                                                    @endcan

                                                </span>
                                                <div class="dropdown d-block d-md-none">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                        <a href="{{ route('users.show', $user->id) }}" class="dropdown-item">Visualizar</a>
                                                        @can('user-edit')
                                                            <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">Editar</a>
                                                        @endcan
                                                        @can('user-delete')
                                                            <button class="dropdown-item" onclick="return confirm('Deseja apagar o usuário ?')">Apagar</button>
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
                                {!! $users->appends($filters)->links() !!}
                            @else
                                {!! $users->links() !!}
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop