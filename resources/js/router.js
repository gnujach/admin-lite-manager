import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent.vue';
import AddCliente from './views/AddCliente';
import AddUser from './views/AddUser';
import ListUsers from './views/ListUsers';
import EditUser from './views/EditUser';
import EditRoles from './views/EditRoles';
Vue.use(VueRouter);

export default new VueRouter({
	routes: [
		{
			path: '/',
			component: ExampleComponent
		},
		{
			path: '/clientes/',
			component: AddCliente
		},
		{
			path: '/admin/usuarios/',
			component: ListUsers
		},
		{
			path: '/admin/usuarios/create',
			component: AddUser
		},
		{
			path: '/admin/usuarios/:id/edit',
			component: EditUser,
			props: true
		},
		{
			path: '/admin/usuarios/editarroles/:id',
			component: EditRoles,
			props: true
		}
	],
	mode: 'history'
});
