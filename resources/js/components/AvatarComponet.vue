<template>
    <div class="relative">
        <button @click="isOpen = !isOpen" class="relative z-10 block h-12 w-12 rounded-full overflow-hidden border-2 border-gray-600 focus:outline-none focus:border-white">
            <img class="h-full w-full object-cover" :src="'/assets/img/avatar/'+updateAvatar">
        </button>
        <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 h-full w-full bg-black opacity-50 cursor-default"></button>
        <div v-if="isOpen" class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-lg shadow-md">
            <router-link :to="'/admin/usuarios/' + user.id + '/edit'" class="block px-4 py-2 text-gray-500 hover:bg-gray-400 hover:text-white">
                <p v-on:click="enlazar">Preferencias</p>
            </router-link>
            <a href="#" v-on:click="enlazar" class="block px-4 py-2 text-gray-500 hover:bg-gray-400 hover:text-white">Ayuda</a>
            <a href="/logout" v-on:click="enlazar" class="block px-4 py-2 text-gray-500 hover:bg-gray-400 hover:text-white">Salir</a>

        </div>
    </div>
</template>
<script>

export default {
  name: "Avatar",
  props: ["user"],
  data() {
    return {
        isOpen: false
    }
  },
  computed: {
      updateAvatar: function() {
          console.log(this.user);
          return this.user.avatar
      }
  },
  created() {
      const handleScape = (e) => {
          if (e.key == 'Esc'  || e.key === 'Escape') {
              this.isOpen = false;
          }
      }
  document.addEventListener('keydown', handleScape)
  this.$once('hook:beforeDestroy', () => {
      document.removeEventListener('keydown', handleScape)
  })
  },
  methods: {
      enlazar() {
          this.isOpen = false;
      }
  }
};
</script>