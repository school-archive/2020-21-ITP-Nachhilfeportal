<template>
  <div class="d-flex flex-row justify-content-center m-3 wrap">
    <Day day="" time="true"/>
    <Day day="Mo" time="false" :user_input="this.$store.getters['get_mo']"/>
    <Day day="Di" time="false" :user_input="this.$store.getters['get_di']"/>
    <Day day="Mi" time="false" :user_input="this.$store.getters['get_mi']"/>
    <Day day="Do" time="false" :user_input="this.$store.getters['get_do']"/>
    <Day day="Fr" time="false" :user_input="this.$store.getters['get_fr']"/>
    <Day day="Sa" time="false" :user_input="this.$store.getters['get_sa']"/>
    <Day day="So" time="false" :user_input="this.$store.getters['get_so']"/>
  </div>
</template>

<script>
import Day from "@/components/Day";
import axios from "axios";
export default {
  name: "Calendar",
  components: {
    Day
  },
  beforeMount() {
    axios.get(`${this.$config.backend_host}/api/user/@me`)
        .then(res => {
          this.$store.commit('add_calendar_all', res.data.data.profile.calender)
        })
  }
}
</script>

<style scoped>
  .wrap {
    overflow-x: hidden;
    overflow-y: scroll;
    /*max-width: 1000px;*/
    height: 500px;
  }
</style>