<template>
  <div v-if="can_actions.length">
    <div class="w-full">
      <AlertError :hidden="showError" msg="Debe seleccionar al menos un permiso" />
      <t-alert
      base-class="border px-4 py-3 rounded relative"
      danger-class="bg-red-100 border-red-400 text-red-700"
      variant="success"
      :show="creado"
    >
    <p>Permisos creados.</p>
</t-alert>

    </div>
    <div class="flex">
      <div class="flex w-1/2 justify-between">
        <div class="block w-full">
          <h2 class="mt-2 text-3xl">
            Permisos para el modelo
            <span class="italic">{{name}}</span>
          </h2>
          <div class="w-full" v-for="item in can_actions" v-bind:key="item">
            <label class="flex items-center">
              <input
                type="checkbox"
                id="item"
                v-model="values"
                :value="item"
                v-on:change="checkItem()"
                class="form-checkbox text-2xl"
                checked
              />
              <span class="ml-2 text-2xl items-center">{{item}}</span>
            </label>
          </div>
        </div>
      </div>
      <div class="w-1/2 mt-2">
        <h2 class="text-2xl mt-2">¿Crear Rol para modelo?</h2>
        <div class="inline-block relative w-64 mt-10">
          <select
            v-model="rol" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
          >
            <option>Si</option>
            <option>No</option>
          </select>
          <div
            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
          >
            <svg
              class="fill-current h-4 w-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full flex align-middle justify-around mt-8">
       <input
       type="reset"
       @click="resetForm"
       value="Cancelar"
        class="ml-2 my-2 bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
      />
      <input
        type="submit"
        class="ml-2 my-2 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        value="Guardar"
        @click="submitForm"
      />
    </div>
  </div>
</template>
<script>
import AlertError from "./AlertError";
export default {
  name: "ComponentPermission",
  components: { AlertError },
  data() {
    return {
      can_actions: [],
      acciones: ["manage-", "view-", "create-", "edit-", "delete-"],
      values: [],
      loading: true,
      showError: false,
      rol: 'Si',
      creado: false,
      errors: []
    };
  },
  props: ["name"],
  created() {
    let _this = this;
    _this.can_actions = _this.acciones.map(value => {
      return value + _this.name;
    });
    _this.values = _this.can_actions;
  },
  methods: {
    checkItem(e) {
      console.log(e);
    },
    checkValues() {
      alert("pressed");
    },
    resetForm() {
      this.$router.go(this.$router.currentRoute)
      // window.location.reload();
    },
    submitForm() {
      let _this = this;
      if (_this.values.length < 1) _this.showError = true;
      else _this.showError = false;
      axios
          .post("/admin/permisos/addpermission", { model: _this.name, values: _this.values, rol: _this.rol  })
          .then(res => {
            _this.creado = true
          })
          .catch (err => {
            _this.errors = err
          })

    }
  }
};
</script>