<template>
<div>
    <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error</strong>
        <span class="block sm:inline">Algo estuvo mal.</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
    <div v-if="sucess"  class="bg-teal-100 border border-t-4 border-teal-500 text-teal-900 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Avatar</strong>
        <span class="block sm:inline">actualizado!</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-teal-900" v-on:click="sucess = false" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
    <div class="flex justify-center">
        <div class="w-1/4 rounded">
            <img :src="'/assets/img/avatar/'+avatar" class="h-16 w-16 rounded-full m-2">
        </div>
        <div class="w-1/4 align-middle">
            <img v-if="image" :src="image" class="h-16 w-16 rounded-full m-2">
        </div>
    </div>
    <div class="py-2">
        <input type="file" v-on:change="onFileChange" class="form-control" />
    </div>
    <div class="py-2">
        <button class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded" @click="upload">Upload</button>
    </div>
</div>
</template>
<script>
export default {
    name: "UploadAvatar",
    data() {
        return {
            image: null,
            error: false,
            sucess: false,
        }
    },
    props: ["avatar"],
  methods: {
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = e => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    upload() {
      axios.post("/profile", { avatar: this.image })
        .then(response => {
            this.sucess = true;
        })
        .catch(error => {
            this.error = true;
        });
    }
  }
}
</script>