@extends('adminlte::page')

@section('title', 'Editar Visitante')

@section('content_header')
    <h1>Editar Visitante</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Editar Visitante</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('guests.update', $guest->id) }}" class="form" method="POST"  enctype="multipart/form-data">
                    @method('PUT')
                    @include('admin.pages.guests._partials.form')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
