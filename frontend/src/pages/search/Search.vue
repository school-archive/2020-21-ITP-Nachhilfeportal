<template>
  <div>
    <h1>Tutorensuche</h1>

    <search-bar/>

    <search-result v-for="res in searchResult" :user-data="res" :key="res.email"/>

  </div>
</template>

<script>
import SearchBar from "../../components/SearchBar";
import axios from "axios";
import SearchResult from "./SearchResult";
export default {
  name: "Search",
  components: {SearchResult, SearchBar},
  metaInfo: {
    title: "Tutoren suchen",
    meta: []
  },
  data() {
    return {
      searchResult: [],
    }
  },
  mounted() {
    axios.get(`${this.$config.backend_host}/api/users/`)
    .then(res => {
      console.log(res);
      if (res.data.success) this.searchResult = res.data.data;
    })
  },
}
</script>

<style scoped>

</style>