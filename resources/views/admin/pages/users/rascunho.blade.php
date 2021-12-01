
                    <hr>
                    <h3>Declaração de Residentes</h3>
                    <hr>

                    <div id="relatives">
                        <div class="row" v-for="(input, index) in inputs">
                            <div class="col-sm-6">
                              <div class="form-group">
                               <label>Nome Completo *</label>
                               <input type="text" :name="'relative[' + index + '][name]'" class="form-control" placeholder="Nome Completo">
                              </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                 <label>Grau de parentesco *</label>
                                    <select :name="'relative[' + index + '][relationship]'" id="relationship" class="form-control">
                                        <option value="" selected>Escolha ... </option>
                                        <option value="Proprietário">Proprietário</option>
                                        <option value="Cônjuge">Cônjuge</option>
                                        <option value="Filho/Filha">Filho/Filha</option>
                                        <option value="Irmão/Irmã">Irmão/Irmã</option>
                                        <option value="Pai/Mãe">Pai/Mãe</option>
                                        <option value="Tio/Tia">Tio/Tia</option>
                                        <option value="Sobrinho/Sobrinha">Sobrinho/Sobrinha</option>
                                        <option value="Outros">Outros</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" @click="deleteRow(index)" class="btn btn-outline-danger rounded-circle">
                                <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                              <button type="button" @click="addRow" class="btn btn-outline-secondary">Adiciona Residente</button>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3>Declaração de Veículos</h3>
                    <hr>
                    <div id="app">
                        <div class="row" v-for="(input, index) in inputs">
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Veículo *</label>
                                <input type="text" :name="'vehicles[' + index + '][type]'" class="form-control" placeholder="Marca e modelo" >
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Placa *</label>
                                <input type="text" :name="'vehicles[' + index + '][plate]'" class="form-control" placeholder="Placa">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                <label>Cor *</label>
                                <input type="text" :name="'vehicles[' + index + '][color]'" class="form-control" placeholder="Cor">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" @click="deleteRow(index)" class="btn btn-outline-danger rounded-circle">
                                <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                              <button type="button" @click="addRow" class="btn btn-outline-secondary">Adiciona Veículo</button>
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
    <script>
        const app = new Vue({
        el: "#app",
        created() {
          this.addRow();
        },
        data: {
          inputs: []
        },
        methods: {
          addRow() {
            this.inputs.push({
              type: "",
              plate: "",
              color: ""
            });
          },
          deleteRow(index) {
            this.inputs.splice(index, 1);
          }
        }
      });

      const relatives = new Vue({
        el: "#relatives",
        created() {
          this.addRow();
        },
        data: {
          inputs: []
        },
        methods: {
          addRow() {
            this.inputs.push({
              name: "",
              relationship: ""
            });
          },
          deleteRow(index) {
            this.inputs.splice(index, 1);
          }
        }
      });

    </script>
