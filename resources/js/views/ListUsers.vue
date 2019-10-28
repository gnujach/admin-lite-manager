<template>
  <div class="flex mb-2">
    <div class="w-full">
      <div v-if="loading">Loading</div>
      <div v-else>
        <div v-if="users.length === 0">
          <p>No hay usuarios</p>
        </div>
        <div v-for="user in users">
          <div class="flex items-baseline border-b border-gray-400 justify-between hover:bg-gray-200">
          <router-link
            :to="'/admin/users/' + user.id"
            class="flex items-center  p-4"
          >
            <UserCircle :name="user.name" />
            <p class="pl-2 font-bold">{{user.name}}</p>
            <p class="pl-2">{{user.email}}</p>
          </router-link>
          <div> 
            <router-link :to="'/admin/usuarios/' + user.id + '/edit'">
              <button class="py-2 px-4 text-green-700 border mr-5 hover:border-green-700 rounded">Editar</button>
            </router-link>
            <router-link :to="'/admin/usuarios/editarroles/' + user.id ">
              <button class="py-2 px-4 text-green-700 border mr-5 hover:border-green-700 rounded">Permisos</button>
            </router-link>
            <router-link :to="'/admin/usuarios/' + user.id + '/edit'">
              <button class="py-2 px-4 text-red-700 border mr-5 hover:border-red-700 rounded">Eliminar</button>
            </router-link>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import UserCircle from "../components/UserCircle";
export default {
  name: "ListUsers",
  components: { UserCircle },
  data() {
    return {
      users: [],
      total: 0,
      loading: false,
      loadingmore: false,
      query: "",
      url: ""
    };
  },
  mounted() {
    this.url = BaseUrl("admin/users");
    this.loadUsers();
  },
  methods: {
    loadUsers() {
      let _this = this;
      _this.loading = true;
      axios
        .get(_this.url)
        .then(res => {
          _this.users = _this.users.concat(res.data.data);
          _this.total = res.data.total;
          _this.loading = false;
          _this.url = res.data.next_page_url;
          console.log(_this.users);
        })
        .catch(err => {
          _this.loading = false;
        });
      console.log("Cargando users");
    }
  }
};
</script>