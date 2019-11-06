<template>
  <div>
    <div class="w-full">
      <form  @submit.prevent="submitForm" class="w-full flex justify-around">
        <label for="model" class="w-1/3 my-2 py-2 text-center text-lg">Nombre</label>
          <div class="w-1/3 my-2">
            <t-input
              id="model"
              v-model="model"
              type="text"
              pattern="^([a-z]+)$"
              maxlength="12"
              autofocus
              required
            />
          </div>
          <div class="w-1/3 my-2 flex justify-center">
            <input type="submit"
              v-bind:disabled="loading"
              class="w-1/2 ml-2 my-2 bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
              value="Buscar"
            >
          </div>
      </form>
    </div>
      <div>
        <AlertError class="mt-4" :hidden="modelInvalid" msg="El modelo ya cuenta con permisos" />
        <ComponentPermission v-if="disponible" :name="model" class="mt-4"></ComponentPermission>
      </div>
    </div>
  </div>
</template>
<script>
import ComponentPermission from "../components/ComponentPermission";
import AlertError from "../components/AlertError";

export default {
  data() {
    return {
      model: null,
      errors: [],
      message: null,
      loading: false,
      disponible: false,
      sendModel: true,
      showError: false,
      modelInvalid: false,      
    };
  },
  components: { ComponentPermission, AlertError },
  methods: {
    addModel() {
      let _this = this;
      console.log(_this.model.length);
      if (_this.model.length > 4 && _this.model.length < 12) {
        // post action rest
        axios
          .post("/admin/permisos/find", { model: this.model })
          .then(res => {
            _this.modelInvalid = res.data.invalido;
            if ( _this.modelInvalid ) {
                _this.sendModel = true;
                _this.showError = true;
            }
              else {
                _this.sendModel = false;
                _this.disponible = true;
              }
          })
          .catch(err => {
            console.log("Error");
          });
      } else {
        _this.modelInvalid = true;
        _this.sendModel = true;
      }
      // _this.sendModel = false;
    },
    submitForm: function() {
      let _this = this;
      _this.addModel();
      console.log("====================================");
      console.log(this.form);
      console.log("====================================");
    }
  }
};
</script>