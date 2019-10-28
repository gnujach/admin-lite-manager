<template>
<div>
    <div class="w-1/2">
      <h1>Preferencias de Usuario</h1>
      <form @submit.prevent="submitForm">
        <label class="block py-2">
          <span class="text-gray-700">Nombre de Usuario</span>
          <input class="form-input mt-1 block w-96" v-model="form.name" />
          <div class="invalid-feedback" v-if="errors.name">
                <p>{{ errors.name[0] }}</p>
          </div>
        </label>
      <div class="flex justify-start">
        <label class="block py-2 mr-4">
          <span class="text-gray-700">Email</span>
          <input class="form-input mt-1 block w-96" v-model="form.email"/>
          <div class="invalid-feedback" v-if="errors.email">
              <p>{{ errors.email[0] }}</p>
          </div>
        </label>
      </div>
      <div class="flex justify-start">
        <label class="block py-2 mr-4">
          <span class="text-gray-700">Password</span>
          <input type="password" v-model="form.password" class="form-input mt-1 block w-96"/>
          <div class="invalid-feedback" v-if="errors.password">
              <p>{{ errors.password[0] }}</p>
          </div>
        </label>
      </div>
        <div class="flex justify-around w-6/12 py-2">
        <button
          class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
        >Cancelar</button>
        <button v-bind:disabled="loading" @click="editUser"
          class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        >Agregar</button>
      </div>
      </form>
    </div>
    <div class="w-1/2">
      <UploadAvatar :avatar="$parent.user.avatar"></UploadAvatar>
    </div>
</div>
</template>
<script>
import UploadAvatar from '../components/UploadAvatar';
export default {
    name: "Edituser",
    data() {
        return {
            errors: [],
            loading: false,
            form: {
                name: null,
                email: null,
                email_confirmation: null,
                password: null,
                password_confirmation: null
            }
        }
    },
    components: {UploadAvatar},
    mounted() {
        axios.get('/admin/users/' + this.$route.params.id + '/edit')
            .then( response => {
                console.log(response.data);
                this.form = response.data;
            })
            .catch (err => {
                console.log(err)
            })
    },
    methods: {
        editUser() {
            axios.patch('/admin/users/'+ this.$route.params.id, this.form)
            .then(response => {
                console.log (response.data)
            })
            .catch(error => {
                console.log("Tenemos algun error => " + error);
            });
        },
        submitForm() {
            console.log("click");
        }
    }
}
</script>