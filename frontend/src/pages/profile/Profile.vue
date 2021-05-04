<template>
<div>
  <div>
    <div class="profile">
    </div>
    <div>
      <h1>Max Mustermann</h1>
      <p>Informationstechnologie</p>
      <p>4.Klasse</p>
    </div>
  </div>
  <Calendar></Calendar>
</div>
</template>

<script>
import Calendar from "../../components/Calendar";
export default {
  name: "Profile",
  components: {Calendar}
}
</script>

<style scoped>

</style>