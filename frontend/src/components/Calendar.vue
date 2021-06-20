<template>
  <div class="d-none">
    <Day day="Mo"/>
    <Day day="Di"/>
    <Day day="Mi"/>
    <Day day="Do"/>
    <Day day="Fr"/>
    <Day day="Sa"/>
    <Day day="So"/>
  </div>
</template>

<script>
import Day from "@/components/Day";
export default {
  name: "Calendar",
  components: {
    Day
  }
}
</script>

<style scoped>

</style>