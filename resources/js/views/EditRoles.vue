<template>
<div class="flex">
    <div class="w-full">
        <div v-if="message" class="bg-red-lightest border border-green-500 text-red-dark pl-4 pr-8 py-3 rounded relative" role="alert">
            <strong class="font-bold">Cambios realizados</strong>
            <span class="block sm:inline">{{message}}</span>
            <span class="absolute pr-2 py-2">
                <svg class="h-6 w-6 text-red" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Cerrar</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
        <div class="w-1/3 py-2">
            <h2 class="py-2 font-bold">Editar rol o roles de {{ usuario.name}}</h2>
        </div>
        <div class="w-1/3 py-2">
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
        <div class="w-1/3 py-2">
        <button
            class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
        >Cancelar</button>
        <button v-bind:disabled="loading" @click="updatesRoles"
            class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        >Agregar</button>
        </div>
    </div>
</div>
</template>
<script>
import Multiselect from "vue-multiselect";
export default {
    components: {
        Multiselect
     },
    data() {
        return {
            usuario: {},
            roles: [],
            errors: [],
            setroles: [],
            message: null,
            loading: false,
            message: null
        }
    },
    mounted() {
        this.getRoles();
        this.getUser();
    },
    methods: {
        updatesRoles() {
            // actualizamos roles
            let _this = this;
            _this.errors = [];
            _this.message = '';
            _this.loading = true;
            axios.post('/admin/users/updateroles', 
            {'roles': this.setroles, 'user_id': this.$route.params.id }).then((res) => {
            _this.loading = false;
            // _this.resetForm();
            _this.message = 'Los roles del usuario han sido actualizados!';
        }).catch((err) => {
            _this.errors = err.response.data.errors;
            _this.loading = false;
        });
        },
        getUser() {
            let _this = this;
            let t_rol = {};
            axios
                .get('/admin/users/' + this.$route.params.id )
                .then(res => {
                    _this.usuario = res.data;
                    _this.usuario.roles.forEach(rol => {
                        t_rol.id = rol.id;
                        t_rol.name = rol.name;
                        // console.log(t_rol);
                        _this.setroles.push(t_rol);
                        t_rol = {};
                        // console.log(_this.setroles);
                    });
                })
                .catch(err => {
                    console.log("Errores" + err);
                });
        },
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
    }
}
</script>