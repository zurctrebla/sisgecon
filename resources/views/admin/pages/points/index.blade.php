@extends('adminlte::page')

@section('title', 'Pontos')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Listar</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="{{-- {{ route('roles.create') }} --}}" class="btn btn-outline-success btn-sm">Cadastrar</a>
            </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Upload file</h3>
            </div>
            <div class="card-body">
                <form action="{{-- {{ route('points.import') }} --}}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.pages.points._partials.form')
                </form>
            </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Download file</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('points.export') }}" class="form" method="GET" enctype="multipart/form-data">
                        @csrf
                        @include('admin.pages.points._partials.form-download')
                    </form>
                </div>
                </div>
                </div>
            </div>

    </div>
@endsection
