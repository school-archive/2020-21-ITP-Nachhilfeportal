<template>
  <div>
    <div class="mensch">
      <img :src="picture_url"><br>
      <h1>{{ profile_data.first_name }} {{ profile_data.last_name }}</h1>
    </div>

    <!--Einstellungen-->
    <div class="wrapper">

      <div class="select">
        <!--Schulstufe-->
        <div >
          <label for="stufe">Schulstufe</label>
          <v-select
              placeholder="Schulstufe"
              label="title"
              :options="['1. Klasse', '2. Klasse', '3. Klasse', '4. Klasse', '5. Klasse']"
              id="stufe"
              v-model="profile_data.grade"
          />
        </div><br>

        <!--Abteilung-->
        <div>
          <label for="abteilung">Abteilung</label>
          <v-select
              placeholder="Abteilung"
              label="Abteilung"
              :options="['Informationstechnologie', 'Mechatronik', 'Informationstechnik']"
              id="abteilung"
              v-model="profile_data.department"
          />
        </div>
        <div >
          <label for="yesno">Tutor</label>
          <v-select
              placeholder="Tutor?"
              label="title"
              :options="['Ja', 'Nein']"
              id="yesno"
              v-model="isTutor"
          />
        </div>
      </div>
      <!--Nur anzeigen wenn Tutor-->
      <div v-if="(isTutor && isTutor !== 'Nein') || isTutor === 'Ja'" class="select">
        <!--Fächer-->
        <div>
          <label for="faecher">Fächer</label>
          <v-select id="faecher"
                    placeholder="Fach"
                    label="title"
                    multiple=""
                    :options="subjects"
                    v-model="profile_data.subjects"
          />
        </div>
        <!--Beschreibung-->
        <div >
          <label for="area">Beschreibung</label>
          <textarea cols="25" id="area" v-model="profile_data.description"></textarea><br>
        </div>


        <!--Methode-->
        <div >
          <label for="method">Methode</label>
          <v-select
              placeholder="Methode"
              label="title"
              multiple=""
              :options="['Vor Ort', 'Online']"
              id="method"
              v-model="profile_data.teaching_method"
          />
        </div>
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
                v-model="day"
            />
          </div>
          <h4>Uhrzeit:</h4>
          Von:
          <div class="additemdate">
            <v-select
                placeholder="von"
                label="title"
                :options="['07:00','07:30','08:00','08:30','09:00','09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30']"
                v-model="from"
            />
            Bis:
            <div class="additemdate">
              <v-select
                  placeholder="bis"
                  label="title"
                  :options="['07:00','07:30','08:00','08:30','09:00','09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00', '18:30']"
                  v-model="to"
              />
            </div>
          </div>
          <button @click="save_calendar">Hinzufügen</button>
        </div>
        <div class="kalender">
          <Calendar settings_page="true"></Calendar>
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
      isTutor : '',
      isTutorNotBoolean: '',
      subjects: [],
      day: '',
      from: '',
      to: ''
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
          if (this.profile_data.grade) this.profile_data.grade = this.profile_data.grade +'. Klasse'
          if ((this.profile_data.department === 'null')) this.profile_data.department = null
          this.isTutor = (res.data.data.isTutor) ? 'Ja' : 'Nein'
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
      if (typeof this.profile_data.grade !== 'undefined') { params.append('grade', (this.profile_data.grade !== null) ? this.profile_data.grade.split('.')[0] : null) }
      if (typeof this.profile_data.department !== 'undefined') { params.append('department', this.profile_data.department) }
      if (typeof this.isTutor !== 'undefined') { params.append('isTutor', (this.isTutor) === 'Ja') }
      if (typeof this.profile_data.description !== 'undefined') { params.append('description', this.profile_data.description) }
      if (typeof this.profile_data.subjects !== 'undefined') { params.append('subjects', this.profile_data.subjects) }
      if (typeof this.profile_data.teaching_method !== 'undefined') { params.append('method', this.get_teaching_method()) }
      params.append('calender', JSON.stringify(this.format_calendar()))

      axios.put(`${this.$config.backend_host}/api/user`, params)
          .then(r => {
            console.log(r);
            this.$router.push({ name: 'Profile', params: { id: this.profile_data.email } })
          })
          .catch(error => console.log(error))
    },
    get_teaching_method() {
      let methods = {
        vor_ort : false,
        online : false
      }
      if(this.profile_data.teaching_method) {
        if (this.profile_data.teaching_method.includes("Vor Ort")) methods.vor_ort = true
        if (this.profile_data.teaching_method.includes("Online")) methods.online = true
      }

      return JSON.stringify(methods)
    },
    save_calendar(){
      if(this.day && this.from && this.to) {
        this.$store.commit('add_calendar_entry', {
          'day' : this.day,
          'time_from' : this.from,
          'time_to' : this.to
        })
        this.day = ''
        this.from = ''
        this.to = ''
      }
    },
    format_calendar() {
      let array = []

      if(this.$store.getters['get_mo'].length>0) {
        this.$store.getters['get_mo'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'Mo'
          })
        })
      }
      if(this.$store.getters['get_di'].length>0) {
        this.$store.getters['get_di'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'Di'
          })
        })
      }
      if(this.$store.getters['get_mi'].length>0) {
        this.$store.getters['get_mi'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'Mi'
          })
        })
      }
      if(this.$store.getters['get_do'].length>0) {
        this.$store.getters['get_do'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'Do'
          })
        })
      }
      if(this.$store.getters['get_fr'].length>0) {
        this.$store.getters['get_fr'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'Fr'
          })
        })
      }
      if(this.$store.getters['get_sa'].length>0) {
        this.$store.getters['get_sa'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'Sa'
          })
        })
      }
      if(this.$store.getters['get_so'].length>0) {
        this.$store.getters['get_so'].forEach(obj => {
          array.push({
            'time_from': obj.time_from,
            'time_to': obj.time_to,
            'day': 'So'
          })
        })
      }

      return array
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
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 40%;
  padding-top: 40px;
}

.select label:first-child {
  font-size: 25px;
  color: colors.$secondary;
  float: left;
  margin-right: 100px;
  padding-bottom: 0.5em;
}

textarea {
  resize: none;
  border-radius: 5px;
  border-color: colors.$third;
  padding-bottom: 0.5em;

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
  padding-bottom: 0.5em;
}

.v-select .vs__dropdown-option--highlight {
  background-color: colors.$primary;
}

.unterer_bereich{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  margin-bottom: 1em;
}
.setting_calender{
  display: flex;
  justify-content: space-around;
}
.kalender{
  padding-top: 1em;
}
.additem {
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