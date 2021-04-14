<template>
  <nav class="navbar">
    <div class="navbar-title">
      <router-link to="/">
        <img src="@/assets/images/logo.png">
        <span>Tutorlink</span>
      </router-link>
    </div>
    <div class="links">
      <router-link to="/">Home</router-link>
      <router-link to="/">Über uns</router-link>
      <a href=""><font-awesome-icon :icon="faSignInAlt"/></a>
      <a href="/"><font-awesome-icon :icon="faSignOutAlt"/></a>
    </div>
  </nav>
</template>

<script>
import { faSignInAlt, faSignOutAlt } from '@fortawesome/free-solid-svg-icons';

export default {
name: "Navbar",
  data() {
    return {
      faSignInAlt,
      faSignOutAlt,
    }
  }
}
</script>

<style lang="scss" scoped>
  @use "src/assets/styles/colors";
  * {
    background-color: colors.$primary;
  }

  .navbar {
    width: 100%;
    background-color: colors.$primary;
    color: white;

    display: flex;
  }
  .navbar-title {
    flex-grow: 1;
    display: flex;
    align-items: center;
  }
  .navbar-title img {
    height: 2rem;
  }
  .navbar-title a {
    display: flex;
    height: 100%;
    padding: calc(1rem - 18px / 2) 1rem;
    box-sizing: border-box;
    align-items: center;
    text-decoration: none;
    color: white;
  }
  .navbar-title a span {
    margin-left: .5rem;
  }

  .navbar .links {
  }

  .navbar .links a {
    display: inline-block;
    color: white;
    text-decoration: none;
    padding: 1rem;
    transition: all .1s;
  }
  .navbar .links a:hover {
    background-color: rgba(black, .1);
  }

</style>