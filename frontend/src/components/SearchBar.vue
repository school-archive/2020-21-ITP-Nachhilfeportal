<template>
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
              :options="subjects"
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
</template>

<script>
import VueSlider from "vue-slider-component";
import axios from "axios";

export default {
  name: "SearchBar",
  components: {
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
      subjects: []
    }
  },
  beforeMount() {
    axios.get(`${this.$config.backend_host}/api/subjects`)
        .then(res => {
          this.subjects = res.data.data;
          console.log(res, this.subjects)
        })
  },
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";


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

body {
  font: 14px/2 "Open sans",sans-serif;
  letter-spacing: 0.05em;
}

.btn {
  display: inline-block;
  padding: 13px 20px;
  color: #fff;
  text-decoration: none;
  position: relative;
  background: transparent;
  border: 1px solid #e1e1e1;
  font: 12px/1.2 "Oswald", sans-serif;
  letter-spacing: 0.4em;
  text-align: center;
  text-indent: 2px;
  text-transform: uppercase;
  transition: color 0.1s linear 0.05s;

  &::before {
    content: "";
    display: block;
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background: #e1e1e1;
    z-index: 1;
    opacity: 0;
    transition: height 0.2s ease, top 0.2s ease, opacity 0s linear 0.2s;
  }

  &::after {
    transition:border 0.1s linear 0.05s;
  }

  .btn-inner {
    position: relative;
    z-index: 2;
  }

  &:hover {
    color: #373737;
    transition: color 0.1s linear 0s;

    &::before {
      top: 0;
      height: 100%;
      opacity: 1;
      transition: height 0.2s ease, top 0.2s ease, opacity 0s linear 0s;
    }

    &::after {
      border-color: #373737;
      transition:border 0.1s linear 0s;
    }
  }
}

</style>
