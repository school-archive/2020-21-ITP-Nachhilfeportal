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
      <a v-if="logged_in" class="link-profile" :href="profile_url"><img class="profile-img" :src="picture_url"/></a>
      <a v-if="logged_in" :href="logout_url"><font-awesome-icon :icon="faSignOutAlt"/></a>
      <a v-else :href="login_url">Anmelden <font-awesome-icon :icon="faSignInAlt"/></a>
    </div>
    <button class="open-mobile-navbar" @click="open_overlay"><font-awesome-icon :icon="faBars"/></button>
    <div class="mobile-nav-overlay" v-show="overlay_open">
      <div class="mobile-links">
        <button class="close-nav" @click="close_overlay"><font-awesome-icon :icon="faTimes"/></button>
        <router-link to="/">Home</router-link>
        <router-link to="/search">Tutoren suchen</router-link>
        <router-link to="/aboutus">Über uns</router-link>
        <a v-if="logged_in" class="link-profile" :href="profile_url"><img class="profile-img" :src="picture_url"/> {{ auth_data.first_name }} {{ auth_data.last_name }}</a>
        <a v-if="logged_in" :href="logout_url">Abmelden <font-awesome-icon :icon="faSignOutAlt"/></a>
        <a v-else :href="login_url">Anmelden <font-awesome-icon :icon="faSignInAlt"/></a>
      </div>
    </div>
  </nav>
</template>

<script>
import { faSignInAlt, faSignOutAlt, faBars, faTimes } from '@fortawesome/free-solid-svg-icons';

export default {
name: "Navbar",
  data() {
    return {
      faSignInAlt,
      faSignOutAlt,
      faBars,
      faTimes,
      logged_in: false,
      auth_data: {},
      overlay_open: false,
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
      return this.$config.backend_host + this.auth_data.profile.picture_url;
    },
    profile_url() {
      console.log(this.auth_data.profile)
      return "/profile/" + this.auth_data.profile.email;
    },
  },
  mounted() {
    this.$auth.get_auth_data(this)
      .then(res => {
        if (res.data.success) this.logged_in = true;
        this.auth_data = res.data.data;
        console.log(this.auth_data)
      })
  },
  methods: {
    open_overlay() {
      document.body.style.overflow = "hidden";
      this.overlay_open = true;
    },
    close_overlay() {
      document.body.style.overflow = null;
      this.overlay_open = false;
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
    display: flex;
    .link-profile {
      padding: 8px;
      line-height: 32px;
      display: flex;
      justify-content: center;
      align-items: center;
      img {
        border-radius: 50%;
        width: 2rem;
      }
    }
  }

  .navbar .links a, .navbar .open-mobile-navbar {
		border: none;
    display: inline-block;
    color: white;
    text-decoration: none;
    padding: 1rem;
    transition: all .1s;

    &:hover {
      background-color: rgba(black, .1);
    }
  }

  .navbar .open-mobile-navbar {
    display: none;
  }

  .mobile-nav-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: transparentize(black, .6);

    .mobile-links {
      position: absolute;
      width: min(80%, 20rem);
      height: 100vh;
      top: 0;
      right: 0;
    }

    .link-profile {
      display: flex !important;
      align-items: center;
      .profile-img {
        border-radius: 50%;
        width: 2rem;
        margin-right: .5rem;
      }
    }

    .mobile-links > * {
      display: block;
      padding: .75rem;
      border: none;
      color: rgba(white, .6);
      width: 100%;
      transition: .2s all ease;
      cursor: pointer;
      &:hover:not(.router-link-exact-active) {
        color: white;
      }
    }

    .mobile-links .close-nav {
      text-align: end;
      padding: 1.5rem;
      padding-bottom: 1rem;
    }

    .mobile-links .router-link-exact-active {
      cursor: default;
      color: rgba(white, .4)
    }
  }

  @media screen and (max-width: 600px) {
    .navbar .links {
      display: none;
    }
    .navbar .open-mobile-navbar {
      display: inline-block;
    }
  }

</style>