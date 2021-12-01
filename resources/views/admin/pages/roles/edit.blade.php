@extends('adminlte::page')

@section('title', 'Editar Nível de Acesso')

@section('content_header')
    <h1>Editar</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Editar Nível de Acesso</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.roles._partials.form')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
