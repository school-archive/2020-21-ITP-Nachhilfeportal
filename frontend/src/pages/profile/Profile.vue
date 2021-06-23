<template>
  <div>
    <div>
      <div class="profile">
        <div>
          <img class="pic" :src="picture_url">
        </div>
        <div class="info">
          <router-link to="/settings" v-if="self">
            <span class="icon"><svg enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg"><path
                d="m22.683 9.394-1.88-.239c-.155-.477-.346-.937-.569-1.374l1.161-1.495c.47-.605.415-1.459-.122-1.979l-1.575-1.575c-.525-.542-1.379-.596-1.985-.127l-1.493 1.161c-.437-.223-.897-.414-1.375-.569l-.239-1.877c-.09-.753-.729-1.32-1.486-1.32h-2.24c-.757 0-1.396.567-1.486 1.317l-.239 1.88c-.478.155-.938.345-1.375.569l-1.494-1.161c-.604-.469-1.458-.415-1.979.122l-1.575 1.574c-.542.526-.597 1.38-.127 1.986l1.161 1.494c-.224.437-.414.897-.569 1.374l-1.877.239c-.753.09-1.32.729-1.32 1.486v2.24c0 .757.567 1.396 1.317 1.486l1.88.239c.155.477.346.937.569 1.374l-1.161 1.495c-.47.605-.415 1.459.122 1.979l1.575 1.575c.526.541 1.379.595 1.985.126l1.494-1.161c.437.224.897.415 1.374.569l.239 1.876c.09.755.729 1.322 1.486 1.322h2.24c.757 0 1.396-.567 1.486-1.317l.239-1.88c.477-.155.937-.346 1.374-.569l1.495 1.161c.605.47 1.459.415 1.979-.122l1.575-1.575c.542-.526.597-1.379.127-1.985l-1.161-1.494c.224-.437.415-.897.569-1.374l1.876-.239c.753-.09 1.32-.729 1.32-1.486v-2.24c.001-.757-.566-1.396-1.316-1.486zm-10.683 7.606c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"/></svg></span>
          </router-link>

          <h1>{{ profile_data.first_name }} {{ profile_data.last_name }}</h1>
          <p class="text">{{ profile_data.department || 'Keine Abteilung gesetzt' }}</p>
          <span class="greyy">{{ profile_data.grade ? `${profile_data.grade}. Klasse` : 'Keine Klasse gesetzt'}}</span><br><br>
          <span style="font-weight: bold">Unterricht : </span>
          <div v-if="isTutor && profile_data.teaching_method">
            <div v-for="method in profile_data.teaching_method" :key="method">
              <button class="button">{{ method }}</button>
            </div>
          </div>
          <div v-else-if="!isTutor">
            Kann nur angezeigt werden wenn Tutor
          </div>
          <div v-else>
            Keine Methode gesetzt
          </div>
          <br><br>
          <span style="font-weight: bold">Fächer : </span>
          <div v-if="isTutor && profile_data.subjects">
            <div v-for="subject in profile_data.subjects" :key="subject">
              <button class="button">{{ subject }}</button>
            </div>
          </div>
          <div v-else-if="!isTutor">
            Kann nur angezeigt werden wenn Tutor
          </div>
          <div v-else>
            Keine Fächer gesetzt
          </div>
          <br><br>
          <span style="font-weight: bold">Über mich :</span> <br>
          <div v-if="isTutor && profile_data.description">
            <p class="übermich">{{ profile_data.description }}</p>
          </div>
          <div v-else-if="!isTutor">
            Kann nur angezeigt werden wenn Tutor
          </div>
          <div v-else>
            Keine Beschreibung gesetzt
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex flex-center">
      <Calendar settings_page="false"></Calendar>
    </div>
  </div>
</template>

<script>

import Calendar from "../../components/Calendar";
import axios from "axios";

export default {
  name: "Profile",
  components: {
    Calendar
  },
  data() {
    return {
      profile_data: {},
      self: '',
      isTutor: ''
    }
  },
  metaInfo: {
    title: "Profil",
    meta: []
  },
  beforeMount() {
    console.log(this.$route.query)
    axios.get(`${this.$config.backend_host}/api/user/${this.$route.params.id}`)
        .then(res => {
          this.profile_data = res.data.data.profile
          if ((this.profile_data.department === 'null')) this.profile_data.department = null
          this.self = res.data.data.self
          this.isTutor = res.data.data.isTutor
        })
  },
  computed: {
    picture_url() {
      return this.$config.backend_host + this.profile_data?.picture_url;
    }
  }
}
</script>

<style lang="scss" scoped>
@use "src/assets/styles/colors";

.button {
  background-color: colors.$secondary;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
  border-radius: 999px;
  font-size: 17px;
}

.text {
  font-size: 25px;
  margin: 0px;
  color: colors.$fourth;
}

.greyy {
  color: colors.$fourth;
}

img {
  border-radius: 50%;
  float: left;
  margin: 10px;
  margin-right: 100px;
  width: 20rem;
}

.profile {
  display: flex;
  justify-content: center;
}

.übermich {
  width: 480px;
  background-color: #F8F8F8;
  border-radius: 10px;
  padding: 4px;
  font-size: 20px;
}

span {
  font-size: 20px;
}

h1 {
  margin: 0px;
  letter-spacing: 2px;
  font-size: 45px;
}

.info{
  width: 20%;
}

.icon {
  margin-top: 15px;
  width: 35px;
  float: right;
  fill: colors.$secondary
}
@media (min-width: 900px) {
  .pic{
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
}

</style>