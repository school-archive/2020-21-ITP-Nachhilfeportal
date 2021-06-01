<template>
  <div>
    <!--Bild und Name-->
    <div class="mensch">
      <img src="@/assets/images/mensch.png" alt="mensch"><br>
      <h1>Herman Maier</h1>
    </div>

    <!--Einstellungen-->
    <div class="wrapper">

      <!--Schulstufe-->
      <div class="select">
        <label for="stufe">Schulstufe</label>
        <v-select
            placeholder="Schulstufe"
            label="title"
            :options="['1. Klasse', '2. Klasse', '3. Klasse', '4. Klasse', '5. Klasse']"
            id="stufe"
        />
      </div><br>

      <!--Abteilung-->
      <div class="select">
        <label for="abteilung">Abteilung</label>
        <v-select
            placeholder="Abteilung"
            label="Abteilung"
            :options="['Informationstechnologie', 'Mechatronik', 'Informationstechnik']"
            id="abteilung"
        />
      </div>

      <!--Nur anzeigen wenn Tutor-->

      <!--Beschreibung-->
      <div class="select">
        <label for="area">Beschreibung</label>
        <textarea cols="25" id="area"></textarea><br>
      </div>


      <!--Methode-->
      <div class="select">
        <label for="method">Methode</label>
        <v-select
            placeholder="Methode"
            label="title"
            multiple=""
            :options="['Vor Ort', 'Online']"
            id="method"
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

.select{
  width:40%;
  margin-bottom: 40px;
}

label {
  font-size: 25px;
  color: colors.$secondary;
  float: left;
  margin-right: 100px;
}

textarea{
  resize: none;
  border-radius: 5px;
  border-color: colors.$third;

}

.wrapper {
  width: 100%;
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}
#stufe,#abteilung,#method,#area{
  width:260px;
  float: right;
}

</style>