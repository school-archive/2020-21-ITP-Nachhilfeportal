<template>
  <div>
    <div class="mensch">
      <img :src="picture_url"><br>
      <h1>{{ profile_data.first_name }} {{ profile_data.last_name }}</h1>
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
            v-model="user_data.grade"
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
            v-model="user_data.department"
        />
      </div>
      <div class="select">
        <label for="yesno">Tutor</label>
        <v-select
            placeholder="Tutor?"
            label="title"
            :options="['Yes', 'No']"
            id="yesno"
        />
      </div>

      <!--Nur anzeigen wenn Tutor-->
      <!--Fächer-->
      <div class="select">
        <label for="faecher">Fächer</label>
        <v-select id="faecher"
                  placeholder="Fach"
                  label="title"
                  multiple=""
                  :options="subjects"
        />
      </div>
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
    <div class="unterer_bereich">
      <div class="setting_calender">
        <div class="additem">
          <h3>Neuen Termin hinzufügen:</h3><br>
          <h4>Wochentag:</h4>
          <div class="additemdate">
            <v-select
                placeholder="Tag"
                label="title"
                :options="['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']"
            />
          </div>
          <h4>Uhrzeit:</h4>
          Von:
          <div class="additemdate">
            <v-select
                placeholder="von"
                label="title"
                :options="['09:00','09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00']"
            />
            Bis:
            <div class="additemdate">
              <v-select
                  placeholder="bis"
                  label="title"
                  :options="['09:00','09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30', '20:00', '20:30', '21:00']"
              />
            </div>
          </div>
          <button>Hinzufügen</button>
        </div>
        <div class="kalender">
          <Calendar></Calendar>
        </div>
      </div>
      <button @click="save" id="submit">Speichern</button>
    </div>
  </div>
</template>

<script>
import Calendar from "../../components/Calendar";
import axios from "axios";




export default {
  name: "Settings",
  components: {Calendar},
  data() {
    return {
      profile_data: {},
      subjects: [],
      user_data: {}
    }
  },
  metaInfo: {
    title: "Profil",
    meta: []
  },
  beforeMount() {
    axios.get(`${this.$config.backend_host}/api/user/@me`)
        .then(res => {
          console.log(res)
          this.profile_data = res.data.data.profile;
          this.isLoaded = true;
          console.log(this.profile_data)
        })

    axios.get(`${this.$config.backend_host}/api/subjects`)
        .then(res => {
          this.subjects = res.data.data;
          console.log(res, this.subjects)
        })
  },
  mounted() {
    console.log(this.profile_data)
  },
  computed: {
    picture_url() {
      return this.$config.backend_host + this.profile_data?.picture_url;
    }
  },
  methods: {
    save() {
      const params = new URLSearchParams();
      if (typeof this.user_data.grade !== 'undefined') { params.append('grade', this.user_data.grade.split('.')[0]) }
      if (typeof this.user_data.department !== 'undefined') { params.append('department', this.user_data.department) }

      axios.put(`${this.$config.backend_host}/api/user`, params)
          .then(r => console.log(r))
          .catch(error => console.log(error))
    }
  },

}
</script>

<style scoped lang="scss" >
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
  padding-top: 10px;
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

.select label:first-child {
  font-size: 25px;
  color: colors.$secondary;
  float: left;
  margin-right: 100px;
}

textarea {
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
  padding-top: 40px;
}
#stufe,#abteilung,#method,#area,#faecher,#yesno{
  width:260px;
  float: right;
}

.v-select .vs__dropdown-option--highlight {
  background-color: colors.$primary;
}

.unterer_bereich{
  display: flex;
  flex-direction: column;
  margin-bottom: 1em;
}
.setting_calender{
  display: flex;
  justify-content: space-between;
}
.kalender{
  margin-right: 35px;
}
.additem {
  padding-left: 150px;
  width: 250px;
  padding-bottom: 10px;
}

#submit{
  width:5em;
  align-self: center;
}
button{
  background-color: colors.$primary;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
  border-radius: 999px;
  font-size: 18px;
  margin-top: 30px;
  float: right;
}
</style>