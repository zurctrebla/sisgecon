@extends('adminlte::page')

@section('title', 'Funcionário')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h3>Histórico de Acesso Funcionário</h3>
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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><strong>{{ $user->name }}</strong></h3>
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

                            @can('employee-create')
                                <th scope="col">Horas</th>
                            @endcan

                          </tr>
                        </thead>
                        <tbody>

                            {{-- @forelse ($collection as $item)

                            @empty

                                <td></td>

                            @endforelse --}}

                            @foreach ($user->points->chunk(4) as $chunk)

                                <?php $item1 = $item2 = $item3 = $item4 = $total = $hours = $minutes = 0; ?>

                                <tr>
                                    @foreach ($chunk as $key => $point)

                                        @if ($loop->first)

                                            <td>
                                                <strong>
                                                    {{ date('d/m/Y', strtotime($point->register)) }}
                                                </strong>
                                            </td>

                                        @endif

                                        <td>
                                            {{ date('H:i:s', strtotime($point->register)) }}

                                            {{-- {{$loop->remaining}}
                                            {{$loop->count}} --}}

                                        </td>

                                        @if ($loop->remaining  == 3)

                                            <?php $item1 = $point->register; ?>

                                        @endif
                                        @if ($loop->remaining  == 2)

                                            <?php $item2 = $point->register; ?>

                                        @endif
                                        @if ($loop->remaining == 1)

                                            <?php $item3 = $point->register; ?>

                                        @endif
                                        @if (($loop->remaining == 0))

                                            <?php $item4 = $point->register; ?>

                                        @endif

                                        @can('employee-create')

                                            @if ($loop->last)

                                                @if ($loop->count == 1)

                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                @endif

                                                @if ($loop->count == 2)

                                                    <td></td>
                                                    <td></td>

                                                @endif
                                                @if ($loop->count == 3)

                                                    <td></td>

                                                @endif

                                                <td>

                                                    <?php

                                                        // Faz o cálculo das horas
                                                        if (($item1 != 0) && ($item2 != 0) && ($item3 != 0) && ($item4 != 0)) {
                                                            $total = (  (strtotime($item2) - strtotime($item1)) + (strtotime($item4) - strtotime($item3))   );
                                                        }

                                                        // if (($item1 == 0) && ($item2 == 0) && ($item3 != 0) && ($item4 != 0)) {
                                                        //     $total = (  (strtotime($item3) - strtotime($item2))   );
                                                        // }

                                                        if (($item1 == 0) && ($item2 == 0) && ($item3 != 0) && ($item4 != 0)) {
                                                            $total = (  (strtotime($item4) - strtotime($item3))   );
                                                        }

                                                        if (($item1 == 0) && ($item2 != 0) && ($item3 != 0) && ($item4 != 0)) {
                                                            $total = (  (strtotime($item3) - strtotime($item2))   );
                                                        }

                                                        if ($total) {
                                                            //$total = (  (strtotime($item2) - strtotime($item1))   );
                                                            //echo "1: " . $item1 . "<br>" . "2: " . $item2 . "<br>"  . "3: " . $item3 . "<br>" .  "4: " . $item4 . "<br>" ;

                                                            // $total = (  (strtotime($item3) - strtotime($item2))   );

                                                            // Encontra as horas trabalhadas
                                                            $hours      = floor($total / 60 / 60);

                                                            // Encontra os minutos trabalhados
                                                            $minutes    = round(($total - ($hours * 60 * 60)) / 60);

                                                            // Formata a hora e minuto para ficar no formato de 2 números, exemplo 00
                                                            $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
                                                            $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

                                                            // Exibe no formato "hora:minuto"
                                                            echo $hours.':'.$minutes;

                                                        }

                                                    ?>

                                                </td>

                                            @endif
                                        @endcan

                                    @endforeach

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

