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
                  :multiple="true"
                  :options="departments"
        />
        <v-select id="search-fach"
                  placeholder="Fach"
                  label="title"
                  :options="['Fach1', 'Fach2', 'Fach3', 'Fach4', 'Fach5', 'Fach6']"
        />
        <div class="search-select-grade">
          <span class="grade-desc"><span v-show="selected_grade[0] === selected_grade[1]">nur</span> {{ selected_grade[0] }}. Klasse <span v-show="selected_grade[0] !== selected_grade[1]">- {{ selected_grade[1] }}. Klasse</span></span>
          <vue-slider class="slider" width="15rem" :data="[1, 2, 3, 4, 5]" :data-labels="{1:'asd',5:'asdsad'}" :drag-on-click="true" :adsorb="true" :contained="true"
                      v-model="selected_grade" :tooltip="'none'"/>
        </div>
        <v-select id="search-teaching-method"
                  placeholder="Methode"
                  multiple=""
                  label="title"
                  :options="['Online', 'Vor Ort']"
        />
        <div>
          <button class="btn-search">Suchen</button>
        </div>
      </div>
    </section>

    <section class="section-text">
      <div class="section-text-left">
        <div class="text">
          <h3>Wie funktioniert es?</h3>
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
            erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
            et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
            sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
            et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
            accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
            no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </div>
        <img src="@/assets/images/work-731198_1920.jpg"/>
      </div>
      <div class="section-text-right">
        <div class="text">
          <h3>Wie funktioniert es?</h3>
          <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
            erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
            et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
            Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
            sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
            et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
            accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
            no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </div>
        <img src="@/assets/images/green-chameleon-s9CC2SKySJM-unsplash.jpg" alt="bild"/>
      </div>
    </section>

    <section class="section-faq">
      <h3>Häufig gestellte Fragen</h3>
      <div class="faqs">
        <faq-tile class="single-faq" question="Muss ich angemeldet sein?" answer="Um alle Funktionen von Tutorlink verwenden zu können, sollten Sie sich mit Ihrem Schul-Microsoft Konto anmelden."/>
        <faq-tile class="single-faq" question="Geht es auch außerhalb von der HTL Rennweg?" answer="Zurzeit ist Tutorlink nur für Schüler*innen der HTL Rennweg verfügbar."/>
        <faq-tile class="single-faq" question="Kann ich Tutor*in sein und gleichzeitig Nachhilfe bekommen?" answer="Um alle Funktionen von Tutorlink verwenden zu können, sollten Sie sich mit Ihrem Schul-Microsoft Konto anmelden."/>
        <faq-tile class="single-faq" question="Wie werde ich Tutor*in?" answer="Um Tutor*in zu werden müssen Sie einfach auf Ihrer Profilseite bei den Einstellungen ihren „Status“ zu Tutor*in ändern"/>
      </div>
    </section>

  </div>
</template>

<script>
import FaqTile from "@/pages/home/FaqTile";
import VueSlider from 'vue-slider-component';
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
      ],
      selected_grade: [1, 5],
    }
  }
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";

.section-landing-page {
  height: calc(100vh - 50px);
  background-image: url("~@/assets/images/Startseite.png");
  background-position: center;
  background-size: cover;

  .title {
    display: flex;
    height: 100%;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    .logo {
      width: 15rem;
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
      font-size: 6rem;
      color: white;
      margin-left: 2rem;
      margin-right: 2rem;
      margin-top: 0;
      margin-bottom: 0;
      letter-spacing: 2px;
    }
  }
}

.section-faq {
  margin-bottom: 3rem;
  margin-top: 4rem;

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
  display: flex;
  justify-content: center;
  padding-top: 3rem;
  padding-bottom: 3rem;

  .searchbar-wrapper {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    width: 80rem;
    max-width: 90%;

    & > div {
      margin: .5rem;
    }
  }

  #search-department {
    width: 18rem;
  }
  #search-fach {
    width: 15rem;
  }
  .search-select-grade {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    .slider {
      width: 15rem;
    }
  }
  #search-teaching-method {
    width: 15rem;
  }

  .btn-search {
    background-color: colors.$primary;
    border-color: transparent;
    color: #fff;
    cursor: pointer;
    border-radius: 999px;
    font-size: 18px;
    height: 34px;
    width: 100px;
  }
}

.section-text > div {
  display: flex;
  flex-wrap: wrap;


  .text, img {
    width: max(min(90%, 30rem), 50%);
    box-sizing: border-box;
  }

  h3{
    color: colors.$secondary;
    font-size: 30px;
  }

  .text {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    font-size: 20px;
  }
}

.section-text {
  .section-text-right {
    flex-direction: row-reverse;
  }
}

</style>

<style lang="scss">
@use "src/assets/styles/colors";
.v-select .vs__dropdown-toggle {
  border-radius: 16px;
  border-color: rgba(0, 0, 0, 0.1);
}

.v-select .vs__selected, .v-select .vs__search {
  margin-left: .75rem;
}

.v-select .vs__actions {
  padding-right: 1.25rem;
}

.v-select:not(.vs--single) {

  .vs__selected {
    background-color: rgba(black, .1);
    border-color: transparent;
    border-radius: 16px;
    padding-left: 8px;
    padding-right: 8px;
    margin-left: .15rem;
  }

  .vs__deselect {
    margin-left: 8px;
  }
}

.v-select .vs__dropdown-option--highlight {
  background-color: colors.$primary;
}

.vue-slider-process {
  background-color: rgba(colors.$primary, .3);
}

.vue-slider:hover .vue-slider-process {
  background-color: rgba(colors.$primary, .6);
}

.vue-slider-dot-handle {
  border-color: rgba(colors.$primary, .3);
}
.vue-slider:hover .vue-slider-dot-handle {
  border-color: rgba(colors.$primary, .6);
}
.vue-slider:hover .vue-slider-dot-handle:hover {
  border-color: rgba(colors.$primary, .9);
}
</style>