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

         <input type="hidden" name="password" class="form-control" placeholder="E-mail:" value="123456" >

        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Data de Nascimento *</label>
         <input type="date" name="birth" id="birth" class="form-control" min="<?php now(); ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
      <div class="form-group">
       <label>Identidade *</label>
       <input type="text" name="name" class="form-control" placeholder="RG:" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Data de emissão *</label>
         <input type="email" name="email" class="form-control" placeholder="Emissão:" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Orgão Emissor *</label>
         <input type="email" name="email" class="form-control" placeholder="Orgão:" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>UF *</label>
         <input type="email" name="email" class="form-control" placeholder="UF:" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
      <div class="form-group">
       <label>Título de Eleitor *</label>
       <input type="text" name="name" class="form-control" placeholder="Título" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Zona *</label>
         <input type="email" name="email" class="form-control" placeholder="Zona" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Sessão *</label>
         <input type="email" name="email" class="form-control" placeholder="Sessão" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
      <div class="form-group">
       <label>CPTS *</label>
       <input type="text" name="name" class="form-control" placeholder="CTPS" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Série *</label>
         <input type="email" name="email" class="form-control" placeholder="Série" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>UF *</label>
         <input type="email" name="email" class="form-control" placeholder="UF" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Data de Emissão *</label>
         <input type="email" name="email" class="form-control" placeholder="Emissão" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <button type="submit" class="btn btn-dark">Enviar</button>
      </div>
    </div>
</div>
