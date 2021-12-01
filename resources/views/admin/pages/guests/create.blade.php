@extends('adminlte::page')

@section('title', 'Cadastrar Visitante')

@section('content_header')
    <h1>Cadastrar Visitante</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Novo Visitante</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('guests.store') }}" class="form" method="POST" enctype="multipart/form-data">
                    @include('admin.pages.guests._partials.form')
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection
