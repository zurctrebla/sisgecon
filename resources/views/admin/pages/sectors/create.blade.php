@extends('adminlte::page')

@section('title', 'Cadastrar Setor')

@section('content_header')
    <h1>Cadastrar Setor</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Novo Setor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('sectors.store') }}" class="form" method="POST">
                    @include('admin.pages.sectors._partials.form')
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection
