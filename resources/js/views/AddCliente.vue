<template>
  <div>
    <form @submit.prevent="submitForm" class="w-full max-w-lg">
      <div class="mt-3">
        <div class>
          <div class="pl-3">
           <t-input-group
            label="Nombre"
            feedback="Only letter without number"
          >
            <t-input
              v-model="form.name"
              type="text"
            />
          </t-input-group>
          </div>
          <div class="pl-3">
            <label class="block">
              <span class="text-gray-700">Primer Apellido</span>
              <input class="form-input mt-1 block w-full" placeholder="Martinez" />
            </label>
          </div>
          <div class="pl-3">
            <label class="block">
              <span class="text-gray-700">Segundo Apellido</span>
              <input class="form-input mt-1 block w-full" placeholder="Gonzalez" />
            </label>
          </div>
        </div>
      </div>
      <div class="mt-4">
        <span class="text-gray-700">Account Type</span>
        <div class="mt-2">
          <label class="inline-flex items-center">
            <input type="radio" class="form-radio" name="accountType" value="personal" />
            <span class="ml-2">Personal</span>
          </label>
          <label class="inline-flex items-center ml-6">
            <input type="radio" class="form-radio" name="accountType" value="busines" />
            <span class="ml-2">Business</span>
          </label>
        </div>
      </div>

      <label class="block mt-4">
        <span class="text-gray-700">Requested Limit</span>
        <select class="form-select mt-1 block w-full">
          <option>$1,000</option>
          <option>$5,000</option>
          <option>$10,000</option>
          <option>$25,000</option>
        </select>
      </label>

      <div class="flex mt-6">
        <label class="flex items-center">
          <input type="checkbox" class="form-checkbox" />
          <span class="ml-2">
            I agree to the
            <span class="underline">privacy policy</span>
          </span>
        </label>
      </div>
      <div class="flex justify-end">
        <button class="py-2 px-4 text-red-700 border mr-5 hover:border-red-700 rounded">Cancel</button>
        <button class="bg-blue-500 py-2 px-4 rounded text-white hover:bg-blue-400">Add New Contact</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        company: "",
        birthday: ""
      },
      error: null
    };
  },
  name: "AddCliente",
  methods: {
    submitForm: function() {
      console.log("====================================");
      console.log(this.form);
      console.log("====================================");
    }
  }
};
</script>