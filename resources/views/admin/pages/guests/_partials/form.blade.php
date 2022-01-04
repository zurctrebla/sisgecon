@csrf
@include('admin.includes.alerts')

<div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>* Nome:</label>
        <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $guest->name ?? old('name') }}">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label>* Documento 1:</label>
        <input type="text" name="document1" class="form-control" placeholder="Documento 1:" value="{{ $guest->document1 ?? old('document1') }}">
      </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
          <label>* Documento 2:</label>
          <input type="text" name="document2" class="form-control" placeholder="Documento 2:" value="{{ $guest->document2 ?? old('document2') }}">
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
                        @foreach($destinies as $destiny)
                            <option value="{{ $destiny->name }}" @if(isset($destiny->name)/*  && $destiny->name== $userRole */) selected @endif>{{ $destiny->name }}</option>
                        @endforeach
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
       <input type="date" name="start_at" id="start_at" class="form-control" min="<?php now(); ?>" value="{{ $guest->start_at ?? old('start_at') }}">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
       <label>Data Final *</label>
       <input type="date" name="expires_at" id="expires_at" class="form-control" value="{{ $guest->expires_at ?? old('expires_at') }}">
      </div>
    </div>
</div>

<div class="contentarea">
    <div class="camera">
        <video id="video">Video stream not available.</video>
        <button id="startbutton">Capturar</button>
    </div>
    <canvas id="canvas">
    </canvas>
    <div class="output">
        <img id="photo" alt="The screen capture will appear in this box.">
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
