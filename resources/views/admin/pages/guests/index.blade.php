@extends('adminlte::page')

@section('title', 'Visitantes')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Listar</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{ route('guests.create') }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
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
                        <form action="{{ route('guests.search') }}" method="POST" class="form form-inline">
                            @csrf
                            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="btn btn-dark">Filtrar</button>
                        </form>
                    </div>
                        <div class="card-body">
                            <table id="guests" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Visitante</th>
                                        <th>Cadastrado por: </th>
                                        <th>Documento</th>
                                        <th>Autorização</th>
                                        <th>Imagem</th>
                                        <th>Setor</th>
                                        <th>Acesso</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $guest)
                                        <tr>
                                            <td>{{ $guest->name }}</td>
                                            <td>{{ $guest->user->name }}</td>
                                            <td>{{ $guest->document1 }}</td>
                                            <td>{{ $guest->authorization }}</td>
                                            <td><img src="{{url("storage/{$guest->photo}")}}" alt="{{$guest->name}}" style="max-width: 80px;"></td>
                                            <td>{{ $guest->destiny }}</td>
                                            <td>
                                                Entrada: {{ date('d/m/Y', strtotime($guest->start_at) )}} </br>
                                                Saída: {{ date('d/m/Y', strtotime($guest->expires_at) )}} </br>
                                                Status:

                                                <?php if ($guest->status == "Pendente") {
                                                            $v = "warning"; $u = "Pendente";
                                                        } elseif ($guest->status == "Bloqueado") {
                                                            $v = "danger"; $u = "Bloqueado";
                                                        } else {
                                                            $v = "success"; $u = "Liberado por {$guest->authorized_at}";
                                                        } ?>

                                                <a href="#" class="badge badge-<?= $v; ?>" data-toggle="modal" data-target="#exampleModalCenter"><?= $u; ?></a>

                                            </td>
                                            <td class="text-center">
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
                                            </td>
                                        </tr>
                                        {{-- modal --}}
                                        <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Visitante</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('guests.update', $guest->id) }}" style="display:inline" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="">Escolha...</option>
                                                                <option value="Autorizado">Autorizar Acesso</option>
                                                                <option value="Bloqueado">Bloquear Acesso</option>
                                                            </select>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                                    </div>
                                                        </form>
                                                </div>
                                                </div>
                                            </div>
                                        {{-- modal --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@stop
