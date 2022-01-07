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
                <a href="{{ route('guests.index') }}" class="btn btn-outline-info btn-sm">Listar</a>
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
                    <a href="{{ route('guests.show', $guest->id) }}" class="btn btn-outline-info btn-sm">Listar</a>
                    @can('guest-edit')
                        <a href="{{ route('guests.edit', $guest->id) }}" class="dropdown-item">Editar</a>
                    @endcan
                    @can('guest-delete')
                        <button class="dropdown-item" onclick="return confirm('Deseja apagar o visitante ?')">Apagar</button>
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
                            <th><?= __('Cadastrado por: ') ?></th>
                            <td>{{ $guest->user->name }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Nome do visitante: ') ?></th>
                            <td>{{ $guest->name }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Veículo: ') ?></th>
                            <td>{{ $guest->model }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Placa do veíclo: ') ?></th>
                            <td>{{ $guest->plate }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Autorização') ?></th>
                            <td>{{ $guest->authorization }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Documento: ') ?></th>
                            <td>{{ $guest->document1 }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Setor: ') ?></th>
                            <td>{{ $guest->destiny }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Falar com quem: ') ?></th>
                            <td>{{ $guest->person }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Empresa: ') ?></th>
                            <td>{{ ($guest->company ?? '') }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Observação: ') ?></th>
                            <td>{{ $guest->obs }}</td>
                        </tr>

                        <tr>
                            <th><?= __('Data Inicial: ') ?></th>
                            <td>{{ date('d/m/Y', strtotime($guest->start_at)) }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Data Final: ') ?></th>
                            <td>{{ date('d/m/Y', strtotime($guest->expires_at)) }}</td>
                        </tr>
                        <tr>
                            <th><?= __('Foto') ?></th>
                            <td><img src="{{url("storage/{$guest->photo}")}}" alt="{{$guest->name}}" style="max-width: 150px;"></td>
                        </tr>
                        <tr>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection
