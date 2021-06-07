<template>
  <span class="bean">
    <slot/>
  </span>
</template>

<script>
export default {
  name: "Bean"
}
</script>

<style scoped lang="scss">
@use "src/assets/styles/colors";

.bean {
  background-color: colors.$secondary;
  color: white;
  border-radius: 500rem;
  padding: .15rem .5rem;
}

</style>