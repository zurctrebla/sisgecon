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
          <label>* Empresa:</label>
          <input type="text" name="company" class="form-control" placeholder="Preencha apenas se for prestador de serviço:" value="{{ $guest->company ?? old('company') }}">
        </div>
      </div>
</div>

<div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <div class="class-form-group">
            <label>* Setor:</label>
            <select name="sector_id" class="form-control">
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
    <div class="col-sm-4">
      <div class="form-group">
        <label>* Falar com quem:</label>
        <input type="text" name="person" class="form-control" placeholder="falar com quem:" value="{{ $guest->person ?? old('person') }}">
      </div>
    </div>
    <div class="col-sm-4">
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
       <input type="date" name="start_at" id="start_at" class="form-control" min="<?= date('Y-m-d'); ?>"  value="{{ $guest->start_at ?? old('start_at') }}">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
       <label>Data Final *</label>
       <input type="date" name="expires_at" id="expires_at" class="form-control" min="<?= date('Y-m-d'); ?>" value="{{ $guest->expires_at ?? old('expires_at') }}">
      </div>
    </div>
</div>

{{-- <div hidden class="contentarea">
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <button id="startbutton">Capturar</button>
    </div>
    <canvas id="canvas">
    </canvas>
    <div class="output">
        <img id="photo" alt="The screen capture will appear in this box.">
    </div>
</div> --}}

{{-- <div hidden class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>* Foto:</label>
        <input type="file" name="photo" class="form-control" >
      </div>
    </div>
</div> --}}

<h3>Documento</h3>
<hr>

<div class="row">
    <div class="col-sm-3">
      <div class="form-group">
       <label>Documento *</label>
            {{-- @foreach ($guest->documents as $document) --}}
                <input type="text" name="doc_no" class="form-control" placeholder="RG, CHN, etc ..." value="{{-- {{ $document->doc_no ?? old('doc_no') }} --}}"required>
            {{-- @endforeach --}}
      </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Data de emissão *</label>
            {{-- @foreach ($guest->documents as $document) --}}
                <input type="date" name="emission" class="form-control" max="<?= date('Y-m-d'); ?>" value="{{-- {{ $document->emission ?? old('emission') }} --}}">
            {{-- @endforeach --}}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>Orgão Emissor *</label>
         <input type="text" name="emission_for" class="form-control" placeholder="Orgão Emissor:" value="{{-- {{ $user->docs->emission_for ?? old('emission_for') }} --}}" >
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
         <label>UF *</label>
         <input type="text" name="uf" class="form-control" placeholder="UF:" value="{{-- {{ $user->docs->uf ?? old('uf') }} --}}" >
        </div>
    </div>
</div>

<h3>Veículo</h3>
<hr>

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>* Modelo:</label>
        <input type="text" name="model" class="form-control" placeholder="Preencha com o modelo do veículo:" value="{{ $guest->model ?? old('model') }}">
      </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
          <label>* Placa:</label>
          <input type="text" name="plate" class="form-control" placeholder="Placa do veículo:" value="{{ $guest->plate ?? old('plate') }}">
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
