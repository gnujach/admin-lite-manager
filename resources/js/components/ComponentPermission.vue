<template>
  <div v-if="can_actions.length">
    <div class="flex w-full">
      <AlertError :hidden="showError" />
    </div>
    <form @submit.prevent="submitForm" class="w-full max-w-lg">
      <div class="flex w-full">
        <h2 class="mt-2 text-3xl">
          Permisos para el modelo
          <span class="italic">{{name}}</span>
        </h2>
        <hr />
      </div>
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
          <span class="ml-2 text-2xl">{{item}}</span>
        </label>
      </div>
      <input
        type="submit"
        class="ml-2 my-2 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        value="Guardar"
      />
    </form>
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
      showError: false
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
    submitForm() {
      let _this = this;
      console.log(_this.values.length);
      if (_this.values.length < 1) _this.showError = true;
      else _this.showError = false;
    }
  }
};
</script>