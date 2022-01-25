@extends('adminlte::page')

@section('title', 'Funcionário')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3>Visualizar</h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <span class="d-none d-md-block">
                <a href="{{ route('users.employee') }}" class="btn btn-outline-info btn-sm">Voltar</a>
            </span>
            <div class="dropdown d-block d-md-none">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-sm">Voltar</a>

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
            <h3 class="card-title">Histórico de Ponto <strong>{{$user->name}}</strong></h3>
          </div>
          <div class="card-body">
            <div class="column-responsive column-80">
                <div class="inputs view content">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saida</th>
                            <th scope="col">Entrada</th>
                            <th scope="col">Saida</th>
                            <th scope="col">Horas</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->points->chunk(4) as $chunk)
                                <tr>
                                    {{-- <td>data</td> --}}

                                        @foreach ($chunk as $key => $point)

                                            @if ($key == 0)


                                                <td><strong>{{ date('d/m/Y', strtotime($point->register)) }}</strong></td>

                                            @endif

                                                <td>{{ date('H:i:s', strtotime($point->register)) }}</td>

                                                @if ($key == 0)
                                                    <?php
                                                        $item1 = $point->register;
                                                    ?>
                                                @endif
                                                @if ($key == 1)
                                                    <?php
                                                        $item2 = $point->register;
                                                    ?>
                                                @endif
                                                @if ($key == 2)
                                                    <?php
                                                        $item3 = $point->register;
                                                    ?>
                                                @endif
                                                @if ($key == 3)
                                                    <?php
                                                        $item4 = $point->register;
                                                    ?>
                                                @endif

                                        @endforeach

                                        @if ($user->points->count() == 3 )

                                            <td></td>

                                        @elseif ($user->points->count() == 2 )

                                            <td></td>
                                            <td></td>

                                        @elseif ($user->points->count() == 1 )

                                            <td></td>
                                            <td></td>
                                            <td></td>

                                        @endif

                                    <td>
                                        @if ($key == 3)

                                            <?php

                                                // Faz o cálculo das horas
                                                $total = (strtotime($item2) - strtotime($item1)) + (strtotime($item4) - strtotime($item3));

                                                $hours      = floor($total / 60 / 60);

                                                // Encontra os minutos trabalhados
                                                $minutes    = round(($total - ($hours * 60 * 60)) / 60);

                                                // Formata a hora e minuto para ficar no formato de 2 números, exemplo 00
                                                $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
                                                $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

                                                // Exibe no formato "hora:minuto"
                                                echo $hours.':'.$minutes;
                                            ?>

                                        @endif
                                    </td>
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

