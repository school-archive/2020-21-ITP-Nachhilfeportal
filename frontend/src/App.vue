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
  }
}
</script>

<style>
</style>
