@include('admin.includes.alerts')

@csrf

<div class="row">
    <div class="col-sm-4">
      <div class="form-group">
       <label>Nome *</label>
       <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $employee->name ?? old('name') }}" required>
      </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
         <label>Email *</label>
         <input type="email" name="email" class="form-control" placeholder="E-mail:" value="{{ $employee->email ?? old('email') }}" @if(isset($employee->email)) disabled @endif required>

         <input type="hidden" name="password" class="form-control" placeholder="E-mail:" value="12345678" >

        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
         <label>Data de Nascimento *</label>
         <input type="date" name="birth" id="birth" class="form-control" max="<?php now(); ?>" value="{{ $employee->employee->birth ?? old('birth') }}" @if(isset($employee->employee->birth)) disabled @endif required>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="form-group">
         <label>Telefone *</label>
         <input type="tel" name="number" class="form-control telephone" pattern="\d{2}\-\d{4}\-\d{4}" placeholder="(99)-9999-9999" data-mask="(99)-9999-9999" value="{{ $employee->phone->number ?? old('number') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
       <label>Função *</label>
       <input type="text" name="function" class="form-control" placeholder="Função" value="{{ $employee->employee->function ?? old('function') }}" @if(isset($employee->employee->function)) disabled @endif required>
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
         <label>Setor *</label>
         <select name="sector_id"class="form-control">
            <option value="">Escolha</option>
                <optgroup label="Selecione um setor">
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->id }}" @if(isset($sector->id)/*  && $sector->name== $employeeRole */) selected @endif>{{ $sector->name }}</option>
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
       <input type="text" name="doc_no" class="form-control" placeholder="RG, CHN, etc ..."  value="{{ $employee->document->doc_no ?? old('doc_no') }}" @if(isset($employee->document->doc_no   )) disabled @endif required>
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
         <input type="text" name="emission_for" class="form-control" placeholder="Orgão Emissor:" value="{{ $employee->doc->emission_for ?? old('emission_for') }}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>UF *</label>
         <input type="text" name="uf" class="form-control" placeholder="UF:" value="{{ $employee->doc->uf ?? old('uf') }}" >
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

<script>
    jQuery(function($){
//   $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
//   $("#phone").mask("(999) 999-9999");
//   $("#tin").mask("99-9999999");
//   $("#ssn").mask("999-99-9999");
  $('.telephone').mask("(99)-9999-9999");
});
</script>
