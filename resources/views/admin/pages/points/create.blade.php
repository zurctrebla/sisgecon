@extends('adminlte::page')

@section('title', 'Cadastrar Função')

@section('content_header')
    <h1>Cadastrar Nível de Acesso</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Novo Nível de Acesso</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" class="form" method="POST">
                    @include('admin.pages.roles._partials.form')
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection
