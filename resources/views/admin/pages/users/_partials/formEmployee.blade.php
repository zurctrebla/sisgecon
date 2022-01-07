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
    <div class="col-sm-2">
        <div class="form-group">
         <label>Data de Nascimento *</label>
         <input type="date" name="birth" id="birth" class="form-control" min="<?php now(); ?>">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
         <label>Sexo *</label>
         <select name="destiny" id="destiny" class="form-control">
            <option value="">Escolha</option>
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
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
    <div class="col-sm-6">
      <div class="form-group">
       <label>Carteira de Reservista *</label>
       <input type="text" name="name" class="form-control" placeholder="reservista:" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
         <label>CNH *</label>
         <input type="email" name="email" class="form-control" placeholder="CNH:" value="{{ $user->email ?? old('email') }}" >
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
    <div class="col-sm-4">
      <div class="form-group">
       <label>PIS/PASEP *</label>
       <input type="text" name="name" class="form-control" placeholder="PIS/PASEP" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>CPF *</label>
         <input type="email" name="email" class="form-control" placeholder="CPF" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Telefone *</label>
         <input type="email" name="email" class="form-control" placeholder="telefone" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
       <label>Endereço *</label>
       <input type="text" name="name" class="form-control" placeholder="endereço completo" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
      <div class="form-group">
       <label>Bairro *</label>
       <input type="text" name="name" class="form-control" placeholder="PIS/PASEP" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Cidade *</label>
         <input type="email" name="email" class="form-control" placeholder="CPF" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>CEP *</label>
         <input type="email" name="email" class="form-control" placeholder="CPF" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
</div>

<h3>Filiação</h3>
<hr>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
       <label>Pai *</label>
       <input type="text" name="name" class="form-control" placeholder="nome do pai" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
         <label>Mãe *</label>
         <input type="email" name="email" class="form-control" placeholder="nome da mãe" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
      <div class="form-group">
       <label>Estado Civil *</label>
       <input type="text" name="name" class="form-control" placeholder="estado civil" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Cônjugue *</label>
         <input type="email" name="email" class="form-control" placeholder="nome do cônjugue" value="{{ $user->email ?? old('email') }}" >
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Grau de instrução *</label>
         <input type="email" name="email" class="form-control" placeholder="grau de instrução" value="{{ $user->email ?? old('email') }}" >
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
