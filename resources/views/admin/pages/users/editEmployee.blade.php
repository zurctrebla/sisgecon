@extends('adminlte::page')

@section('title', 'Editar Funcionário')

@section('content_header')
    <h1>Editar Funcionário</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Editar Funcionário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.updateEmployee', $user->id) }}" class="form" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pages.users._partials.formEmployee3')
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
