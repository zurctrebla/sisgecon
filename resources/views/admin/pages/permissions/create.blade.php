@extends('adminlte::page')

@section('title', 'Cadastrar Nova Permissão')

@section('content_header')
<h1>Cadastrar Nova Permissão</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Nova Permissão</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store') }}" class="form" method="POST">
                            @include('admin.pages.permissions._partials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
