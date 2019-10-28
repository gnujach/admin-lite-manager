<template>
  <div
    class="rounded-full border border-gray-400 text-white bg-blue-400 w-10 h-10 flex justify-center items-center"
  >{{nameCircle}}</div>
</template>
<script>
export default {
  name: "UserCircle",
  props: ["name"],
  data() {
    return {};
  },
  computed: {
    nameCircle: function() {
      return this.name
        .match(/[a-z]/g)
        .slice(0, 2)
        .join("");
    }
  }
};
</script>