@extends('adminlte::page')

@section('title', 'Editar Permissão')

@section('content_header')
    <h1>Editar</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Editar Permissão</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('permissions.update', $permission->id) }}" class="form" method="POST">
                    @method('PUT')
                    @include('admin.pages.permissions._partials.form')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
