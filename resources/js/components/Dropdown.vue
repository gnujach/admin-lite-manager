<template>
  <div class="relative">
    <div class="flex items-center cursor-pointer text-sm text-blue py-1 px-2">
      <p @click="isOpen = !isOpen" class="text-gray-500 uppercase text-sm font-bold">{{title}}</p>
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
      </svg>
    </div>
    <slot name="list" v-if="isOpen" class="items-center p-1 p-2 w-full"></slot>
  </div>
</template>
<script>
export default {
  name: "Dropdown",
  props: ["title", "isOpen"],
  data() {
    return {
      isOpen: false
    };
  },
  methods: {
    changeOpen: function() {
      return (this.isOpen = !this.isOpen);
    }
  }
};
</script>