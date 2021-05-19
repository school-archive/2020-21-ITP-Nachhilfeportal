<template>
  <div id="app">
    <navbar/>
    <router-view/>
    <custom-footer/>
  </div>
</template>

<script>

import Navbar from "@/components/Navbar";
import CustomFooter from "@/components/CustomFooter";

export default {
  name: 'App',
  components: {
    CustomFooter,
    Navbar
  },
  metaInfo: {
    // if no subcomponents specify a metaInfo.title, this title will be used
    title: 'Default Title',
    // all titles will be injected into this template
    titleTemplate: '%s | Nachhilfeportal'
  }
}
</script>

<style>
</style>
