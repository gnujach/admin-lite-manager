import Vue from 'vue';
import router from './router';
import App from './components/App';
import VueTailwind from 'vue-tailwind';
import MyOwnTheme from './MyTailWindTheme'

require('./bootstrap');
Vue.use(VueTailwind, {
	theme: MyOwnTheme
});
const app = new Vue({
	el: '#app',
	components: {
		App
	},
	data() {
		return {
			user: AuthUser
		};
	},
	methods: {
		userCan(permission) {
			if (this.user && this.user.allPermissions.includes(permission)) {
				return true;
			}
			return false;
		},
		// MakeUrl(path) {
		// 	return BaseUrl(path);
		// }
	},
	router
});