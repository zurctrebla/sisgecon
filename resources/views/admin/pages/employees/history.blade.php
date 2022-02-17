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
              <a href="{{ route('employees.pdf', $employee->id) }}" class="btn btn-outline-secondary btn-sm">PDF</a>
                <a href="{{ route('employees.index') }}" class="btn btn-outline-info btn-sm">Voltar</a>
            </span>
            <div class="dropdown d-block d-md-none">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-outline-info btn-sm">Voltar</a>

                </div>
            </div>
        </ol>
      </div>
    </div>
@stop

@section('content')

@include('admin.includes.alerts')

<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><strong>{{ $employee->name }}</strong></h3>
          </div>
          <div class="card-body">
            <div class="column-responsive column-80">
                <div class="inputs view content">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width:120px;">Data</th>
                            <th style="width:120px; text-align:center;">Horário</th>
                            <th style="width:120px; text-align:center;">Status</th>
                            <th scope="col">Motivo</th>
                          </tr>
                        </thead>
                        <tbody>

                            @include('admin.pages.employees._partials.table5')

                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection

