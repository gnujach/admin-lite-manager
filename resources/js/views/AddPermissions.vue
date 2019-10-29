<template>
    <div class="flex">
        <form @submit.prevent="submitForm" class="w-full flex justify-around">
            <label class="py-3 text-blue-500 font-bold mr-2">Modelo <span class="italic">(en singular)</span></label>
            <input  type="text" id="model" class="form-input mt-1 block w-96 mr-2" v-model="model" placeholder="venta" autofocus>
            <button v-bind:disabled="loading" @click="addUser"
          class="ml-2 my-2 bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
        >Agregar</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            model: null,
            errors: [],
            message: null
        }
    }
}
</script>