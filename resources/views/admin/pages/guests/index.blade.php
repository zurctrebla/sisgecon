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
            <ol hidden class="breadcrumb float-sm-right">
                <a href="{{-- {{ route('guests.history') }} --}}" class="btn btn-outline-light btn-sm">Historico</a>
            </ol>
            <ol class="breadcrumb float-sm-right">
                @can('guest-create')
                    <a href="{{ route('guests.create') }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
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
                                        <th>Informações</th>
                                        <th hidden>Imagem</th>
                                        <th>Acesso</th>
                                        <th>Entrada</th>
                                        <th>Saída</th>
                                        <th>Entrada</th>
                                        <th>Saída</th>
                                        <th class="text-center">Registros</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $guest)
                                    {{-- {{ dd($guest) }} --}}
                                        <tr>
                                            <td>
                                                Nome: <strong style="color: blue">{{ $guest->name }}</strong><br>
                                                Cadastrado por: {{ $guest->user->name }}
                                            </td>

                                            <td>
                                                @foreach ($guest->documents as $document)

                                                    Documento: {{ $document->doc_no }}<br>

                                                @endforeach
                                                Autorização: {{ $guest->authorization }}<br>
                                                Setor: {{ $guest->sector->name }}
                                            </td>

                                            <td hidden><img src="{{url("storage/{$guest->photo}")}}" alt="{{$guest->name}}" style="max-width: 80px;"></td>
                                            <td>
                                                Entrada: {{ date('d/m/Y', strtotime($guest->start_at) )}} </br>
                                                Saída: {{ date('d/m/Y', strtotime($guest->expires_at) )}} </br>
                                                Status:
                                                <?php if ($guest->status == "Pendente") {
                                                            $v = "warning"; $u = "Pendente"; $t = "#exampleModalCenter";
                                                        } elseif ($guest->status == "Bloqueado") {
                                                            $v = "danger"; $u = "Bloqueado"; $t = "#exampleModalCenter";
                                                        } elseif ($guest->status == "Expirado") {
                                                            $v = "danger"; $u = "Expirado"; $t = "";
                                                        } else {
                                                            $v = "success"; $u = "Liberado por {$guest->authorized_at}"; $t = "#exampleModalCenter";
                                                        } ?>

                                                <a href="#" class="badge badge-<?= $v; ?>" data-toggle="modal" data-target="#exampleModalCenter<?= $guest->id;?>"><?= $u; ?></a>

                                            </td>

                                            {{-- se não existe registros, monta as colunas --}}
                                            @if (!$guest->points->last())

                                                <?php $key = 0; ?>

                                                @for ($i = 4; $i > $key; $i--)

                                                    <td></td>

                                                @endfor

                                            @endif

                                            @foreach ($guest->points->chunk(4) as $chunk)

                                                @foreach ($chunk as $key => $point)

                                                    @if ($point->register > date('Y-m-d'))

                                                        <td>
                                                            <strong>
                                                                <p style="color:<?php if ($key % 2 == 0){ echo "green"; }else{ echo "red"; } ?>">{{-- aqui inserir operador ternário --}}
                                                                    {{ ($point->register) ? date('H:i:s', strtotime($point->register)) : '' }}
                                                                </p>
                                                            </strong>
                                                        </td>

                                                    @endif

                                                @endforeach

                                                @for ($i = 3; $i > $key; $i--)

                                                    <td></td>

                                                @endfor

                                            @endforeach

                                            <td class="text-center">
                                                <span class="d-none d-md-block">

                                                    @can('guest-list')
                                                    <style>
                                                        .disabled-link {
                                                        pointer-events: none;
                                                        }
                                                    </style>
                                                        <a href="{{ route('guests.register', $guest->id) }}" class="btn btn-outline-<?php if ($key % 2 == 0){ echo "dark"; }else{ echo "danger"; } ?> btn-sm" data-toggle="modal" data-target="<?php if ($v == "success") {echo "#exampleModal2";}?><?= $guest->id;?>" >Registrar</a>
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
                                        <div class="modal fade" id="exampleModal2<?= $guest->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Title" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal2Title">Visitante</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('guests.register', $guest->id) }}" style="display:inline" method="GET">
                                                        @csrf

                                                        <div>
                                                            Registrar Visitante <strong>{{$guest->name}}</strong> em {{date('d/m/Y H:i:s')}} ?
                                                        </div>

                                                        @if ($key >= 3)
                                                        <div>
                                                            Visitante já possui todos os registros do dia.<br>
                                                            Precisa justificar novo registro.
                                                        </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Motivo *</label>
                                                                        <input type="text" name="reason" class="form-control" placeholder="Motivo" min="5" max="200" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                </div>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                    {{-- modal --}}
                                        {{-- modal --}}
                                        <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?= $guest->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                            <select name="status" class="form-control">
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
        {{-- <div class="card-footer">
            @if (isset($filters))
                {!! $guests->appends($filters)->links() !!}
            @else
                {!! $guests->links() !!}
            @endif
        </div> --}}
    </div>
@stop
