@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1>Editar Usuário</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Editar Usuário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.users._partials.form')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
