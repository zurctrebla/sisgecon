@extends('adminlte::page')

@section('title', 'Visitante')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3>Visualizar</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">            
            <span class="d-none d-md-block">
                <a href="{{ route('guests.pdf', $guest->id) }}" class="btn btn-outline-secondary btn-sm">PDF</a>
                <a href="{{ route('guests.index') }}" class="btn btn-outline-info btn-sm">Voltar</a>
            </span>
            <div class="dropdown d-block d-md-none">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">

                    <a href="{{ route('guests.pdf', $guest->id) }}" class="dropdown-item">PDF</a>                    
                    <a href="{{ route('guests.index') }}" class="dropdown-item">Voltar</a>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Histórico de Acesso Visitante <strong>{{$guest->name}}</strong></h3>
          </div>
          {{--  --}}
          <div class="card-body">
            <table id="guests" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Cadastrado por:</th>
                        <th>Liberado por:</th>
                        <th>Documento</th>
                        <th>Autorização</th>
                        <th>Setor</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ $guest->user->name }}</td>
                        <td>{{ $guest->authorized_at }}</td>
                        <td>
                            @foreach ($guest->documents as $document)

                            {{ $document->doc_no }}<br>

                            @endforeach
                        </td>
                        <td>{{ $guest->authorization }}</td>
                        <td>{{ $guest->sector->name }}</td>
                        <td>{{ date('d/m/Y', strtotime($guest->start_at) )}}</td>
                        <td>{{ date('d/m/Y', strtotime($guest->expires_at) )}}</td>
                        <td>{{ $guest->status }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
        {{--  --}}
          <div class="card-body">
            <div class="column-responsive column-80">
                <div class="inputs view content">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">data</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saida</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saida</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($guest->points->chunk(4) as $chunk)
                                <tr>
                                    @foreach ($chunk as $point)

                                    @if ($loop->first)
                                        <td>
                                            <strong>
                                                {{ date('d/m/Y', strtotime($point->register)) }}
                                            </strong>
                                        </td>
                                    @endif

                                        <td>{{ date('H:i:s', strtotime($point->register)) }}</td>

                                    @endforeach

                                    @if ($guest->points->count() == 3 )

                                        <td></td>

                                    @elseif ($guest->points->count() == 2 )

                                        <td></td>
                                        <td></td>

                                    @elseif ($guest->points->count() == 1 )

                                        <td></td>
                                        <td></td>
                                        <td></td>

                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection

