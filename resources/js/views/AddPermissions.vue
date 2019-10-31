<template>
  <div>
    <div class="w-full">
      <div class="w-full flex justify-around">
        <label class="py-3 text-blue-500 font-bold mr-2">
          Modelo
          <span class="italic">(en singular)</span>
        </label>
        <input
          v-bind:disabled="!sendModel"
          type="text"
          id="model"
          class="form-input mt-1 block w-96 mr-2 uppercase"
          v-model="model"
          placeholder="venta"
          autofocus
        />
        <button
          v-bind:disabled="loading"
          @click="addModel"
          class="ml-2 my-2 bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
        >Agregar</button>
      </div>
      <div>
        <ComponentPermission v-if="disponible" :name="model" class="mt-4"></ComponentPermission>
      </div>
    </div>
  </div>
</template>
<script>
import ComponentPermission from "../components/ComponentPermission";
export default {
  data() {
    return {
      model: null,
      errors: [],
      message: null,
      loading: false,
      disponible: false,
      sendModel: true
    };
  },
  components: { ComponentPermission },
  methods: {
    addModel() {
      let _this = this;
      // post action rest
      axios
        .post("/admin/permisos/find", { model: this.model })
        .then(res => {
          _this.disponible = true;
        })
        .catch(err => {
          console.log("Error");
        });
      _this.sendModel = false;
    },
    submitForm: function() {
      console.log("====================================");
      console.log(this.form);
      console.log("====================================");
    }
  }
};
</script>