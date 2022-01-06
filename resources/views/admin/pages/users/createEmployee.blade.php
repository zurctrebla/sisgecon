@extends('adminlte::page')

@section('title', 'Cadastrar Funcionário')

@section('content_header')
    <h1>Cadastrar Funcionário</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Novo Funcionário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.storeEmployee') }}" class="form" method="POST">
                    @csrf
                    @include('admin.pages.users._partials.formEmployee')
                </form>
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection
