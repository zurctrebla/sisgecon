@include('admin.includes.alerts')
@csrf
<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
       <label>Nome *</label>
       <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $role->name ?? old('name') }}" >
      </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
         <label>Permissões *</label>
            <br>
            {{-- @foreach ($permission as $permission)
            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
            <br>
            @endforeach --}}
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
