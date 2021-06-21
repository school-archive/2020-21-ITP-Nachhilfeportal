<template>
  <div>
    <h1 class="title">Tutorensuche</h1>

    <search-bar class="search-bar"/>


    <div class="result-wrapper">
      <search-result v-for="res in searchResult" :user-data="res" :key="res.email"/>
    </div>

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
    axios.get(`${this.$config.backend_host}/api/search/`)
    .then(res => {
      console.log(res);
      if (res.data.success) this.searchResult = res.data.data;
    })
  },
}
</script>

<style scoped lang="scss">
  .result-wrapper {
    display: flex;
    flex-direction: column;
    flex-flow: wrap;
    justify-content: center;
  }

  .result-wrapper > * {
    margin: .75rem;
  }

  .search-bar {
    display: flex;
    width: 100%;
    justify-content: center;
  }

  .title {
    font-size: 3rem;
    text-align: center;
  }
</style>