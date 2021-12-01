@extends('adminlte::page')

@section('title', 'Atualizar Perfil')

@section('content_header')
    <h1>Atualizar Perfil</h1>
@stop

@section('content')
    <div class="container-fluid">
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Atualizar Perfil</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" class="form" method="POST">
                    @method('PUT')
                    {{-- @include('admin.pages.users._partials.form') --}}
                    @include('admin.includes.alerts')

                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                           <label>Nome *</label>
                           <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}" >
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                             <label>Email *</label>
                             <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ $user->email ?? old('email') }}" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                             <label>Contato Telefônico *</label>
                             <input type="text" name="number" class="form-control" placeholder="..." value="{{ $user->phones->number ?? old('number') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                           <label>Nacionalidade *</label>
                           <input type="text" name="nacionality" class="form-control" placeholder="..." value="{{ $user->complement->nacionality ?? old('nacionality') }}" required>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                             <label>Estado *</label>
                             <input type="text" name="state" class="form-control" placeholder="..." value="{{ $user->complement->state ?? old('state') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                           <label>Data de nascimento *</label>
                           <input type="date" name="birth" class="form-control" placeholder="..." value="{{ $user->complement->birth ?? old('birth') }}" required>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                             <label>CPF *</label>
                             <input type="text" name="cpf" class="form-control" placeholder="..." value="{{ $user->complement->cpf ?? old('cpf') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                             <label>RG *</label>
                             <input type="text" name="rg" class="form-control" placeholder="..." value="{{ $user->complement->rg ?? old('rg') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                           <label>Quadra *</label>
                           <input type="text" name="block" class="form-control" placeholder="..." value="{{ $user->complement->block ?? old('block') }}" required>
                          </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                             <label>Lote *</label>
                             <input type="text" name="lot" class="form-control" placeholder="..." value="{{ $user->complement->lot ?? old('lot') }}" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                             <label>Casa *</label>
                             <input type="text" name="house" class="form-control" placeholder="..." value="{{ $user->complement->house ?? old('house') }}" required>
                            </div>
                        </div>
                    </div>



                        <div class="class-form-group">
                            <button type="submit" class="btn btn-dark">Enviar</button>
                        </div>
                    </div>

                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
