@include('admin.includes.alerts')
@csrf

<div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label>Carregar arquivo (.csv) *</label>
        <input type="file" name="file" class="form-control" required>
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
