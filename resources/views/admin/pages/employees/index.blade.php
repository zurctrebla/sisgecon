@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content_header')
    <div class="container-fluid">
        @include('admin.includes.alerts')
        <div class="row mb-2">
            <div class="col-sm-6">
            <h3>Listar</h3>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @can('employee-create')
                    <a href="{{ route('employees.create') }}" class="btn btn-outline-success btn-sm">Cadastrar</a>
                @endcan
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
                        <form action="{{ route('employees.search') }}" method="POST" class="form form-inline">
                            @csrf
                            <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                            <button type="submit" class="btn btn-dark">Filtrar</button>
                        </form>
                    </div>
                        <div class="card-body">
                            <table id="employees" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Entrada</th>
                                        <th>Saída</th>
                                        <th>Entrada</th>
                                        <th>Saída</th>
                                        <th class="text-center">Registros</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>
                                                {{ $employee->name }}
                                            </td>
                                            {{-- se não existe registros, monta as colunas --}}
                                            @if (!$employee->points->last())

                                                <?php $key = 0; ?>

                                                @for ($i = 4; $i > $key; $i--)

                                                    <td></td>

                                                @endfor

                                            @endif

                                                @foreach ($employee->points->chunk(4) as $chunk)

                                                    @foreach ($chunk as $key => $point)

                                                        @if ($point->register > date('Y-m-d'))

                                                            <td>
                                                                <strong>
                                                                    <p style="color:<?php if ($key % 2 == 0){ echo "green"; }else{ echo "red"; } ?>">
                                                                        {{ ($point->hour) ? date('H:i:s', strtotime($point->hour)) : '' }}
                                                                    </p>
                                                                </strong>
                                                            </td>

                                                        @endif

                                                    @endforeach

                                                    @for ($i = 3; $i > $key; $i--)

                                                        <td></td>

                                                    @endfor

                                                @endforeach
                                            <td class="text-center">
                                                @include('admin.pages.employees._partials.registers')
                                            </td>
                                            <td class="text-center">
                                                @include('admin.pages.employees._partials.actions')
                                            </td>
                                        </tr>
                                            @include('admin.pages.employees._partials.modal-index')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            @if (isset($filters))
                                {!! $employees->appends($filters)->links() !!}
                            @else
                                {!! $employees->links() !!}
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
          alert("Precisa de autorização!");
        }
        </script>
@stop
