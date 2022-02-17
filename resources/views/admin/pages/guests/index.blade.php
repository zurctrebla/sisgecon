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
                                        <tr>
                                            <td>
                                                Nome: <strong style="color: blue">{{ $guest->name ?? ''}}</strong><br>
                                                Cadastrado por: {{ $guest->user->name ?? ''}}
                                            </td>
                                            <td>
                                                Documento: {{ $guest->document->doc_no ?? ''}}<br>
                                                Autorização: {{ $guest->authorization ?? ''}}<br>    
                                                Setor: {{ $guest->sector->name ?? ''}}
                                            </td>
                                            <td hidden><img src="{{url("storage/{$guest->photo}")}}" alt="{{$guest->name}}" style="max-width: 80px;"></td>
                                            <td>
                                                Entrada: {{ date('d/m/Y', strtotime($guest->start_at) )}} </br>
                                                Saída: {{ date('d/m/Y', strtotime($guest->expires_at) )}} </br>
                                                Status:
                                                @if ($guest->status == "Pendente") 
                                                    <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#exampleModalCenter<?= $guest->id;?>">Pendente</a>
                                                @elseif($guest->status == "Bloqueado")
                                                    <a href="#" class="badge badge-danger" data-toggle="modal" data-target="#exampleModalCenter<?= $guest->id;?>">Bloqueado</a>
                                                @elseif($guest->status == "Expirado")
                                                    <a href="#" class="badge badge-danger" data-toggle="modal" data-target="">Expirado</a>
                                                @else
                                                    <a href="#" class="badge badge-success" data-toggle="modal" data-target="#exampleModalCenter<?= $guest->id;?>">Liberado por {{$guest->authorized_at}}</a>
                                                @endif
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
                                                                @if ($key % 2 == 0)
                                                                        <p style="color:rgb(0, 167, 0)">
                                                                        {{ ($point->hour) ? date('H:i:s', strtotime($point->hour)) : '' }}
                                                                    </p>
                                                                @else
                                                                    <p style="color:#f00">
                                                                        {{ ($point->hour) ? date('H:i:s', strtotime($point->hour)) : '' }}
                                                                    </p>
                                                                @endif
                                                            </strong>
                                                        </td>
                                                    @endif
                                                @endforeach
                                                @for ($i = 3; $i > $key; $i--)
                                                    <td></td>
                                                @endfor
                                            @endforeach
                                            <td class="text-center">
                                                @include('admin.pages.guests._partials.registers')
                                            </td>
                                            <td class="text-center">
                                                @include('admin.pages.guests._partials.actions')
                                            </td>
                                        </tr>
                                        @include('admin.pages.guests._partials.modal-register')
                                        @include('admin.pages.guests._partials.modal-authorize')                                        
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $guests->appends($filters)->links() !!}
            @else
                {!! $guests->links() !!}
            @endif
        </div>
    </div>
@stop
