<template>
  <div class="d-flex flex-row justify-content-center m-3 wrap calendar">
    <Day day="" time="true"/>
    <Day day="Mo" time="false" :user_input="this.$store.getters['get_mo']" :settings_page="settings_page"/>
    <Day day="Di" time="false" :user_input="this.$store.getters['get_di']" :settings_page="settings_page"/>
    <Day day="Mi" time="false" :user_input="this.$store.getters['get_mi']" :settings_page="settings_page"/>
    <Day day="Do" time="false" :user_input="this.$store.getters['get_do']" :settings_page="settings_page"/>
    <Day day="Fr" time="false" :user_input="this.$store.getters['get_fr']" :settings_page="settings_page"/>
    <Day day="Sa" time="false" :user_input="this.$store.getters['get_sa']" :settings_page="settings_page"/>
    <Day day="So" time="false" :user_input="this.$store.getters['get_so']" :settings_page="settings_page"/>
  </div>
</template>

<script>
import Day from "./Day";
import axios from "axios";
export default {
  name: "Calendar",
  components: {
    Day
  },
  props: {
    settings_page: String
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
  .calendar {
    max-width: 1000px;
    min-width: 250px;
    border-radius: 8px 8px 0 0;
    box-shadow: 0 30px 50px rgba(0, 0, 0, 0.2) ,0 3px 7px rgba(0, 0, 0, 0.1);
    margin-top: 8px;
    margin-bottom: 30px;
  }
</style>