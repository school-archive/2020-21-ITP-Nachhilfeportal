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
            :options="departments"
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

    .searchbar-wrapper {
      width: 100%;
      display: flex;
      flex-direction: row;
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