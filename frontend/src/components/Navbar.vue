<template>
  <nav class="navbar">
    <div class="navbar-title">
      <router-link to="/">
        <img src="@/assets/images/logo_white.svg">
        <span>Tutorlink</span>
      </router-link>
    </div>
    <div class="links">
      <router-link to="/">Home</router-link>
      <router-link to="/search">Tutoren suchen</router-link>
      <router-link to="/aboutus">Über uns</router-link>
      <a v-if="logged_in" class="link-profile"><img class="profile-img" :src="picture_url"/></a>
      <a v-if="logged_in" :href="logout_url"><font-awesome-icon :icon="faSignOutAlt"/></a>
      <a v-else :href="login_url">Anmelden <font-awesome-icon :icon="faSignInAlt"/></a>
      <!--<a href="/"><font-awesome-icon :icon="faSignOutAlt"/></a>-->
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
      logged_in: false,
      auth_data: {},
    }
  },
  computed: {
    login_url() {
      return `${this.$config.backend_host}/api/auth/login/redirect`;
    },
    logout_url() {
      return `${this.$config.backend_host}/api/auth/logout`;
    },
    picture_url() {
      return this.$config.backend_host + this.auth_data.picture_url;
    },
  },
  mounted() {
    this.$auth.get_auth_data(this)
      .then(res => {
        if (res.data.success) this.logged_in = true;
        this.auth_data = res.data.data;
        console.log(this.auth_data)
      })
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
		border: none;
    box-sizing: border-box;
    align-items: center;
    text-decoration: none;
    color: white;
  }
  .navbar-title a span {
    margin-left: .5rem;
  }

  .navbar .links {
    overflow: auto;
    .link-profile {
      padding: 8px;
      line-height: 32px;
      img {
        border-radius: 50%;
        width: 2rem;
      }
    }
  }

  .navbar .links a {
		border: none;
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