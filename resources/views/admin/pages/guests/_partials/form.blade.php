@csrf
@include('admin.includes.alerts')

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>* Nome:</label>
        <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $guest->name ?? old('name') }}">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>* Documento:</label>
        <input type="text" name="document" class="form-control" placeholder="Documento oficial:" value="{{ $guest->document ?? old('document') }}">
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <div class="class-form-group">
            <label>* Setor:</label>
            <select name="destiny" id="destiny" class="form-control">
                <option value="">Escolha</option>
                    <optgroup label="Selecione um setor">
                        <option value="setor 01">setor 01</option>
                        <option value="setor 02">setor 02</option>
                        <option value="setor 03">setor 03</option>
                        <option value="setor 04">setor 04</option>
                        <option value="setor 05">setor 05</option>
                        {{-- @foreach($destinies as $destiny)
                            <option value="{{ $destiny->name }}">{{ $destiny->name }}</option>
                        @endforeach --}}
                    </optgroup>
            </select>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>* Falar com quem:</label>
        <input type="text" name="person" class="form-control" placeholder="falar com quem:" value="{{ $guest->person ?? old('person') }}">
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>* Empresa:</label>
        <input type="text" name="company" class="form-control" placeholder="Preencha apenas se for prestador de serviço:" value="{{ $guest->company ?? old('company') }}">
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>* Observação:</label>
        <input type="textarea" name="obs" class="form-control" placeholder="Alguma observação:" value="{{ $guest->obs ?? old('obs') }}">
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
       <label>Data Inicial *</label>
       <input type="date" name="start_at" id="start_at" class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
       <label>Data Final *</label>
       <input type="date" name="expires_at" id="expires_at" class="form-control">
      </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>* Foto:</label>
        <input type="file" name="photo" class="form-control" >
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
