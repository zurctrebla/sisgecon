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

         <input type="hidden" name="password" class="form-control" placeholder="E-mail:" value="12345678" >

        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
         <label>Data de Nascimento *</label>
         <input type="date" name="birth" id="birth" class="form-control" max="<?php now(); ?>">
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
         <label>Telefone *</label>
         <input type="text" name="number" class="form-control" placeholder="Telefone" value="{{ $user->phones->number ?? old('number') }}" >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
       <label>Função *</label>
       <input type="text" name="function" class="form-control" placeholder="Função" value="{{ $user->name ?? old('name') }}" >
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
         <label>Setor *</label>
         <select name="sector_id"class="form-control">
            <option value="">Escolha</option>
                <optgroup label="Selecione um setor">
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->id }}" @if(isset($sector->id)/*  && $sector->name== $userRole */) selected @endif>{{ $sector->name }}</option>
                    @endforeach
                </optgroup>
        </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-3">
      <div class="form-group">
       <label>Documento *</label>
       <input type="text" name="doc_no" class="form-control" placeholder="RG, CHN, etc ..." value="{{ $user->docs->doc_no ?? old('doc_no') }}" >
      </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Data de emissão *</label>
         <input type="date" name="emission" class="form-control" max="<?php now(); ?>">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Orgão Emissor *</label>
         <input type="text" name="emission_for" class="form-control" placeholder="Orgão Emissor:" value="{{ $user->docs->emission_for ?? old('emission_for') }}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>UF *</label>
         <input type="text" name="uf" class="form-control" placeholder="UF:" value="{{ $user->docs->uf ?? old('uf') }}" >
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
