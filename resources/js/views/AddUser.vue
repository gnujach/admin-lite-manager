<template>
  <div class="flex">
    <div class="w-full">
      <label class="block py-2">
        <span class="text-gray-700">Nombre de Usuario</span>
        <input class="form-input mt-1 block w-96" v-model="name" placeholder="j_martinez" />
        <div class="invalid-feedback" v-if="errors.name">
              <p>{{ errors.name[0] }}</p>
          </div>
      </label>
      <div class="flex justify-start">
        <label class="block py-2 mr-4">
          <span class="text-gray-700">Email</span>
          <input class="form-input mt-1 block w-96" v-model="email" placeholder="jose.a@gmailcom" />
          <div class="invalid-feedback" v-if="errors.email">
              <p>{{ errors.email[0] }}</p>
          </div>
        </label>
        <label class="block py-2">
          <span class="text-gray-700">Repetir Email</span>
          <input class="form-input mt-1 block w-96" v-model="email_confirmation" placeholder="jose.a@gmailcom" />
        </label>
      </div>
      <div class="flex justify-start">
        <label class="block py-2 mr-4">
          <span class="text-gray-700">Password</span>
          <input type="password" v-model="password" class="form-input mt-1 block w-96" placeholder />
          <div class="invalid-feedback" v-if="errors.password">
              <p>{{ errors.password[0] }}</p>
          </div>
        </label>
        <label class="block py-2">
          <span class="text-gray-700">Repite Password</span>
          <input type="password" v-model="password_confirmation" class="form-input mt-1 block w-96" placeholder />
        </label>
      </div>
      <div class="w-96 py-2">
        <label class="typo__label">Selecciona Roles</label>
        <multiselect
          v-model="setroles"
          :options="roles"
          :custom-label="nameWithLang"
          placeholder="Selecciona Roles"
          selectLabel="Clic para seleccionar"
          deselectLabel="Clic para remover"
          selectedLabel="Seleccionado"
          label="name"
          track-by="name"
          :multiple="true"
          :close-on-select="false"
          :preserve-search="false"
          :showLabels="false"
        ></multiselect>
      </div>
      <div class="flex justify-around w-6/12 py-2">
        <button
          class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
        >Cancelar</button>
        <button v-bind:disabled="loading" @click="addUser"
          class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        >Agregar</button>
      </div>
    </div>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
export default {
  name: "AddUser",
  components: {
    Multiselect
  },
  data() {
    return {
        name: '',
        email: '',
        email_confirmation: '',
        password: '',
        password_confirmation: '',
        errors: [],
      roles: [],
      setroles: null,
      message: null,
      loading: false
    };
  },
  mounted() {
    this.getRoles();
  },
  methods: {
    getRoles() {
      let _this = this;
      axios
        .get("/admin/users/roles")
        .then(res => {
          _this.roles = res.data;
          console.log("====================================");
          console.log(_this.roles);
          console.log("====================================");
        })
        .catch(err => {});
    },
    nameWithLang({ name }) {
      return `${name}`;
    },
    addUser() {
        let _this = this;
        _this.errors = [];
        _this.message = '';
        _this.loading = true;   
        axios.post('/admin/users/', 
            {'name': this.name, 'roles': this.setroles, 'email': this.email,  'password': this.password, 'password_confirmation': this.password_confirmation}).then((res) => {
            _this.loading = false;
            _this.resetForm();
            _this.message = 'User account has been successfully created!';
        }).catch((err) => {
            _this.errors = err.response.data.errors;
            _this.loading = false;
        });
    },
    resetForm() {
        this.name = '';
        this.email = '';
        this.password = '';
        this.setroles = null;
        this.password_confirmation = '';
    }
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>