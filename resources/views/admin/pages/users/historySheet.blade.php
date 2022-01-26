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
            <h3 class="card-title">Histórico de Acesso <strong>{{$user->name}}</strong></h3>
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
                            @foreach ($user->points->chunk(4) as $chunk)

                                <?php $item1 = $item2 = $item3 = $item4 = $total = $hours = $minutes = 0;?>

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

                                            {{$loop->remaining}}
                                            {{$loop->count}}

                                        </td>

                                        @if ($loop->remaining  == 3)

                                            <?php echo "item 1 : " . $item1 = $point->register . "<br>"; ?>

                                        @endif
                                        @if ($loop->remaining  == 2)

                                            <?php echo "item 2 : " . $item2 = $point->register . "<br>"; ?>

                                        @endif
                                        @if ($loop->remaining == 1)

                                            <?php echo "item 3 : " . $item3 = $point->register . "<br>"; ?>

                                        @endif
                                        @if (($loop->remaining == 0))

                                            <?php echo "item 4 : " . $item4 = $point->register . "<br>"; ?>

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

                                                    {{-- {{ ($item4)  ? date_diff(new DateTime($item4), new DateTime($item3))->format('%H:%I:%S') : '' }} --}}
                                                    {{-- {{ ($item4)  ? date_diff(new DateTime($item4), new DateTime($item1))->format('%H:%I:%S') : '' }} --}}
                                                    <?php

                                                    // $item4 = preg_replace('/[\&\.\;\" "]+/', '', $item4);

                                                    // $item1 = preg_replace('/[\&\.\;\" "]+/', '', $item1);

                                                    // $item1 = str_replace(array("&", ";"), '', $item1);

                                                    // $item4 = str_replace(array("&", ";"), '', $item4);

                                                    //$pregValue = str_replace(['.', ','], [',', '.'], preg_replace('#[^0-9\.,]#', '', $value));




                                                        $datetime1 = new DateTime($item4);
                                                        $datetime2 = new DateTime($item1);
                                                        $interval = $datetime1->diff($datetime2);
                                                        echo $interval->format('%H:%I:%S');

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

