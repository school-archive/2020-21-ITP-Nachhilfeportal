<template>
  <div>
    <div class="mensch">
      <img src="@/assets/images/mensch.png" alt="mensch"><br>
      <h1>Herman Maier</h1>
    </div>
    <div class="wrapper">
      <span>Schulstufe</span>
      <div class="select">
        <v-select
            placeholder="Schulstufe"
            label="title"
            :options="['1. Klasse', '2. Klasse', '3. Klasse', '4. Klasse', '5. Klasse']"
        />
      </div><br>
      <span>Abteilung</span>
      <div class="select">
        <v-select
            placeholder="Abteilung"
            label="title"
            :options="['Informationstechnologie', 'Mechatronik', 'Informationstechnik']"
        />
      </div>
      <p>NUR TUTOR OPTIONEN</p>
      <span>Beschreibung</span>
      <textarea rows="4" cols="35"></textarea><br>
      <span>Methode</span>
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
  padding-top: 10px;
}

.select {
  width: 250px;
}

span {
  font-size: 25px;
  color: colors.$secondary;

}

textarea{
  resize: none;
  border-radius: 5px;
  border-color: colors.$secondary;
}

.wrapper {
  width: 100%;
  position: center;
}

p{
  font-size: 28px;
  letter-spacing: 2px;
}
</style>