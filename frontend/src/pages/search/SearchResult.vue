<template>
  <router-link class="container" :to="`/profile/${userData.email}`">
    <div class="left">
      <img class="profile-img" :src="picture_url">
    </div>
    <div class="right">
      <p class="name">{{ userData.first_name }} {{ userData.last_name }}</p>
      <p class="grade-department">{{ userData.grade ? `${userData.grade}. Klasse` : 'Keine Klasse gesetzt'}} | {{ userData.department || 'Keine Abteilung gesetzt' }}</p>
      <p class="teaching-methods">Unterrichtet
        <bean v-for="method of userData.teaching_method" :key="method">{{ method }}</bean>
      </p>
      <p class="lectures">Fächer:
        <bean v-for="subject of userData.subjects" :key="subject">{{ subject }}</bean>
      </p>
    </div>
  </router-link>
</template>

<script>
import Bean from "./Bean";
export default {
  name: "SearchResult",
  components: {Bean},
  props: {
    userData: Object
  },
  mounted() {
    console.log(this.userData)
  },
  computed: {
    picture_url() {
      return this.$config.backend_host + this.userData?.picture_url;
    }
  }
}
</script>

<style scoped lang="scss">
@use "src/assets/styles/colors";

.container {
  display: inline-flex;
  align-items: center;
  border: 1px lighten(black, 90) solid;
  border-radius: 1rem;
  padding: 0 1.5rem;
  color: black;
}

.profile-img {
  border-radius: 50%;
  height: 5rem;
  margin: 2rem;
}

.right p {
  margin: 0;
}

.right .name {
  font-weight: bold;
  font-size: 1.1rem;
  line-height: normal;
}

.right .grade-department {
  color: colors.$fourth;
}
.bean {
  margin-right: .25rem;
}

</style>