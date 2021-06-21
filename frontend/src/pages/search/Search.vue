<template>
  <div class="search">
    <h1 class="title">Tutorensuche</h1>

    <search-bar :search-data="searchData" class="search-bar" @submit="on_search"/>


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
  props: {
    searchData: Object
  },
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
    if (this.searchData) {
      this.on_search(this.searchData);
      console.log(this.searchData)
    }
  },
  methods: {
    on_search(event) {
      axios.get(`${this.$config.backend_host}/api/search/` +
          `?grade_from=${event.selected_grade[0]}&grade_to=${event.selected_grade[1]}` +
          `&department=${event.selected_department}&name=${event.selected_subject}`)
          .then(res => {
            console.log(res);
            if (res.data.success) this.searchResult = res.data.data;
          })
    }
  }
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

  .search {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>