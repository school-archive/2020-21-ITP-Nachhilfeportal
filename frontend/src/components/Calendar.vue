<template>
  <div class="d-flex flex-row justify-content-center m-3 wrap">
    <Day day="" time="true"/>
    <Day day="Mo" time="false" :user_input="calendar.Mo"/>
    <Day day="Di" time="false" :user_input="calendar.Di"/>
    <Day day="Mi" time="false" :user_input="calendar.Mi"/>
    <Day day="Do" time="false" :user_input="calendar.Do"/>
    <Day day="Fr" time="false" :user_input="calendar.Fr"/>
    <Day day="Sa" time="false" :user_input="calendar.Sa"/>
    <Day day="So" time="false" :user_input="calendar.So"/>
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
  data() {
    return {
      calendar: {}
    }
  },
  beforeMount() {
    axios.get(`${this.$config.backend_host}/api/user/@me`)
        .then(res => {
          this.calendar = res.data.data.profile.calender
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