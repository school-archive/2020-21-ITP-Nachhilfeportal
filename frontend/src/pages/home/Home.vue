<template>
  <div>

    <section class="section-landing-page">
      <div class="title">
        <div class="logo">
          <img src="@/assets/images/logo_red.png">
        </div>
        <h1>Tutorlink</h1>
      </div>
    </section>

    <section class="section-searchbar">
      <div class="searchbar-wrapper">
        <v-select id="search-department"
            placeholder="Abteilung"
            label="title"
            :options="departments"
        />
        <v-select id="search-fach"
            placeholder="Fach"
            label="title"
            :options="departments"
        />
        <v-select id="search-klasse"
            placeholder="Klasse"
            multiple=""
            label="title"
            :options="['1. Klasse', '2. Klasse', '3. Klasse', '4. Klasse', '5. Klasse']"
        />
        <vue-slider :data="[1, 2, 3, 4, 5]" :drag-on-click="true" :adsorb="true" :contained="true"/>
        <v-select id="search-teaching-method"
            placeholder="Methode"
            multiple=""
            label="title"
            :options="['Online', 'Vor Ort']"
        />
        <button>Jetzt Suchen</button>
      </div>
    </section>

    <section class="section-text">
      Wie funktioniert es?
    </section>

    <section class="section-faq">
      <h3>Frequently Asked Questions</h3>
      <div class="faqs">
        <faq-tile class="single-faq" v-for="i in [1,2,3,4]" :key="i" :question="`Frage ${i}`" :answer="`Antwort ${i}`"/>
      </div>
    </section>

  </div>
</template>

<script>
import FaqTile from "@/pages/home/FaqTile";
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'

export default {
  name: "Home",
  components: {
    FaqTile,
    VueSlider
  },
  data() {
    return {
      departments: [
          "Informationstechnologie",
          "Mechatronik",
          "Fachschule"
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
  @use "src/assets/styles/colors";

  .section-landing-page {
    height: calc(100vh - 50px);
    background-image: url("~@/assets/images/pexels-element-digital-1370295.jpg");
    background-size: cover;

    .title {
      display: flex;
      height: 100%;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      .logo {
        width: 12rem;
        margin: 2rem;
        margin-top:    .125rem;
        margin-bottom: .125rem;
        img {
          height: 100%;
          width: 100%;
        }
      }
      h1 {
        display: inline-block;
        font-size: 4rem;
        color: white;
        margin-left: 2rem;
        margin-right: 2rem;
        margin-top: 0;
        margin-bottom: 0;
      }
    }
  }

  .section-faq {
    margin-bottom: 3rem;

    h3 {
      text-align: center;
    }

    .faqs {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;

      .single-faq {
        margin-top: .1rem;
      }
    }
  }

  .section-searchbar {

    #search-department {
      width: 15rem;
    }
    #search-fach {
      width: 15rem;
    }
  }





</style>

<style lang="scss">

$vs-state-active-bg: #e358fb;
$vs-selected-bg: #e358fb;
$vs-dropdown-bg: #e358fb;
</style>