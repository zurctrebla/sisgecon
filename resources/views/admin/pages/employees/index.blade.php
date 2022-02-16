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
                                                                        {{ ($point->hora_ocorrencia) ? date('H:i:s', strtotime($point->hora_ocorrencia)) : '' }}
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
                                                <span class="d-none d-md-block">

                                                    {{-- @can('employees-register') --}}
                                                        <a href="{{ route('employees.register', $employee->id) }}" class="btn btn-outline-<?php if ($key % 2 == 0){ echo "dark"; }else{ echo "danger"; } ?> btn-sm" data-toggle="modal" data-target="#exampleModalCenter<?= $employee->id;?>">Registrar</a>
                                                    {{-- @endcan --}}

                                                    {{-- @can('employees-history') --}}
                                                        <a href="{{ route('employees.history', $employee->id) }}" class="btn btn-outline-primary btn-sm">Ver Histórico</a>
                                                    {{-- @endcan --}}

                                                    @can('employee-edit')
                                                        <a hidden href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                                                    @endcan

                                                </span>
                                                <div class="dropdown d-block d-md-none">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                        @can('employee-edit')
                                                        <div hidden>
                                                            <a hidden href="{{ route('employees.show', $employee->id) }}" class="dropdown-item">Visualizar</a>

                                                        </div>
                                                        @endcan
                                                        @can('employee-edit')
                                                            <a href="{{ route('employees.edit', $employee->id) }}" class="dropdown-item">Editar</a>
                                                        @endcan
                                                        @can('employee-delete')
                                                        <div hidden >
                                                            <button hidden class="dropdown-item" onclick="return confirm('Deseja apagar o usuário ?')">Apagar</button>

                                                        </div>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="d-none d-md-block">
                                                    <a hidden href="{{ route('guests.show', $employee->id) }}" class="btn btn-outline-primary btn-sm">Visualizar</a>
                                                    @can('employee-edit')
                                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-warning btn-sm">Editar</a>
                                                    @endcan
                                                    @can('employee-delete')
                                                        <form hidden action="{{ route('employees.destroy', $employee->id) }}" style="display:inline" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja apagar o visitante ?')" >Apagar</button>
                                                        </form>
                                                    @endcan
                                                </span>
                                                <div class="dropdown d-block d-md-none">
                                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                                        <a href="{{ route('employees.show', $employee->id) }}" class="dropdown-item">Visualizar</a>
                                                        @can('employee-edit')
                                                            <a href="{{ route('employees.edit', $employee->id) }}" class="dropdown-item">Editar</a>
                                                        @endcan
                                                        @can('employee-delete')
                                                            <button class="dropdown-item" onclick="return confirm('Deseja apagar o visitante ?')">Apagar</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- modal --}}
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter<?= $employee->id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Funcionário</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('employees.register', $employee->id) }}" style="display:inline" method="GET">
                                                        @csrf

                                                        <div>
                                                            Registrar Funcionário <strong>{{$employee->name}}</strong> em {{date('d/m/Y H:i:s')}} ?
                                                        </div>

                                                        @if ($key >= 3)
                                                        <div>
                                                            Funcionário já possui todos os registros do dia.<br>
                                                            Precisa justificar novo registro.
                                                        </div>
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label>Motivo *</label>
                                                                        <input type="text" name="reason" class="form-control" placeholder="Motivo" min="5" max="200" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                </div>
                                                    </form>
                                            </div>
                                            </div>
                                        </div>
                                    {{-- modal --}}
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
