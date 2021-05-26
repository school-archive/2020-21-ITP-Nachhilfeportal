<template>
  <div>
    <div class="left">
      <img src="">
    </div>
    <div class="right">
      <p class="name">{{ userData.first_name }} {{ userData.last_name }}</p>
      <p class="text">{{ userData.department || 'Keine Abteilung gesetzt' }}</p>
      <span class="grey">{{ userData.grade ? `${userData.grade}. Klasse` : 'Keine Klasse gesetzt'}}</span><br><br>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchResult",
  props: {
    userData: Object
  }
}
</script>

<style scoped>

</style>