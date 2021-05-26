<template>
  <div>
    <div class="mensch">
      <img src="@/assets/images/mensch.png" alt="mensch"><br>
      <h1>Herman Maier</h1>
    </div>
    <div class="wrapper">
      <div>
        <p>Schulstufe</p>
        <div class="select">
          <v-select
              placeholder="Schulstufe"
              label="title"
              :options="['1. Klasse', '2. Klasse', '3. Klasse', '4. Klasse', '5. Klasse']"
          />
        </div>
        <p>Abteilung</p>
        <div class="select">
          <v-select
              placeholder="Abteilung"
              label="title"
              :options="['Informationstechnologie', 'Mechatronik', 'Informationstechnik']"
          />
        </div>
        <h4>NUR TUTOR OPTIONEN</h4>
        <p>Beschreibung</p>
        <p>Methode</p>
      </div>
      <div class="select">
        <v-select
            placeholder="Methode"
            label="title"
            multiple=""
            :options="['Vor Ort', 'Online']"
        />
      </div>
    </div>
    <Calendar></Calendar>
  </div>
</template>

<script>
import Calendar from "../../components/Calendar";

export default {
  name: "Settings",
  components: {Calendar}
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";


.mensch {
  background-color: colors.$third;
  width: 100%;
  height: 300px;
  text-align: center;
}

h1 {
  color: white;
  display: inline-block;
  text-align: left;
}

img {
  border-radius: 50%;
  width: 200px;
  height: 200px;
  white-space: pre-wrap;
}

.select {
  width: 250px;
  float: right;
}

p {
  font-size: 25px;
  color: colors.$secondary;
}

.wrapper{
  width: 800px;
  display: flex;
  justify-content: center;
}
</style>