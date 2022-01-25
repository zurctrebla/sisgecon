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
                <a href="{{ route('guest.index') }}" class="btn btn-outline-info btn-sm">Voltar</a>
            </span>
            <div class="dropdown d-block d-md-none">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                    <a href="{{ route('guest.show', $guest->id) }}" class="btn btn-outline-info btn-sm">Voltar</a>

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
            <h3 class="card-title">Histórico de Ponto <strong>{{$guest->name}}</strong></h3>
          </div>
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
                            <th scope="col">Horas</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($guest->points->chunk(4) as $chunk)
                                <tr>
                                    <td>data</td>

                                        @foreach ($chunk as $point)

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

                                    <td>horas</td>
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

