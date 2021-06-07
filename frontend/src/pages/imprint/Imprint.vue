<template>
  <div>
    <img src="@/assets/images/Imprint.png" alt="imprint" class="crop-center">
    <div>
      <p class="u1">Impressum</p>
    </div>
    <div class="imprint">
      <div class="tutorlink">
        <p id="u2">Tutorlink Project:</p>
        Rennweg 89B<br>
        Wien | Österreich<br>
        <br>
        <br>
        Kontakt:<br>
        <span><font-awesome-icon :icon="faEnvelope"/> <a href="mailto:tutorlink.project@gmail.com">tutorlink.project@gmail.com</a></span><br>
        <span><font-awesome-icon :icon="faPhoneAlt"/> <a href="tel:+43 650 9879007">+43 650 9879007</a></span><br>
        <br>
      </div>
      <div class="rennweg">
        <p id="u3">Schulstandort:</p>
        <a href="https://www.htlrennweg.at/"><img src="@/assets/images/htlw3r_logo.png" alt="htlw3r"><br></a>
        HTL Wien 3 Rennweg<br>
        Rennweg 89B<br>
        1030 Wien<br>
      </div>
    </div>
  </div>
</template>

<script>
import {faEnvelope} from '@fortawesome/free-regular-svg-icons';
import {faPhoneAlt} from '@fortawesome/free-solid-svg-icons';
export default {
  name: "Imprint",
  data() {
    return {
      faEnvelope,
      faPhoneAlt
    }
  },
  metaInfo: {
    title: "Impressum",
    meta: []
  },
}
</script>

<style scoped lang="scss">
@use "src/assets/styles/colors";

img.crop-center {
  height: 250px;
  width: 100% !important;
  object-fit: cover;
  object-position: top center;
}

.imprint{
  width: 70%;
  display: flex;
  flex-direction: row;
  justify-content: space-around;
}
.u1{
  font-weight: 200;
  font-style: initial;
  font-size: 35px;
  padding-left: 0.5em;
  letter-spacing: 2.5px;
  color: colors.$fourth;
  margin-top: 20px;
}

#u2, #u3 {
  letter-spacing: 2px;
  color: colors.$fourth;
  font-style: initial;
  font-size: 28px;
}
.tutorlink {
  font-family: dinosaur, sans-serif;
  font-weight: 50;
  font-style: initial;
  letter-spacing: 2px;
  color: colors.$fourth;
  font-size: 26px;
  padding-right: 1em;
}

.rennweg {
  font-family: dinosaur, sans-serif;
  font-weight: 50;
  font-style: initial;
  letter-spacing: 2px;
  color: colors.$fourth;
  font-size: 26px;
  margin-bottom: 1em;
}
.rennweg img {
  width: 300px;
}

a {
  text-decoration: none;
  color: colors.$fourth;
}
@media (max-width: 1000px ) {
  .imprint{
    display: flex;
    flex-direction: column;
  }
  .tutorlink, .rennweg{
    margin-left: 1em;
  }
}

/*
.u1 {
  font-family: dinosaur, sans-serif;
  font-weight: 200;
  font-style: initial;
  font-size: 40px;
  padding-left: 1em;
  padding-top: 0.5em;
  letter-spacing: 2.5px;
  color: colors.$fourth;
}
.tutorlink {
  font-family: dinosaur, sans-serif;
  font-weight: 50;
  font-style: initial;
  letter-spacing: 2.5px;
  color: colors.$fourth;
  margin-right: 150px;
}

.rennweg {
  font-family: dinosaur, sans-serif;
  font-weight: 50;
  font-style: initial;
  letter-spacing: 2.5px;
  color: colors.$fourth;
  margin-bottom: 150px;
}
.rennweg img {
  width: 300px;
}

a {
  text-decoration: none;
  color: colors.$fourth;
}
@media (max-width: 576px) {

  .tutorlink {
    font-size: 22px;
    padding-left: 2.5em;
    padding-top: 1em;
    margin-bottom: 40px;
  }

  .rennweg {
    font-size: 22px;
    padding-top: 1em;
    padding-left: 2.5em;
    letter-spacing: 2.5px;
  }
}

// Small devices (landscape phones, 576px and up)
@media (min-width: 576px) {

  .tutorlink {
    font-size: 25px;
    padding-left: 6em;
    padding-top: 1em;
    float: left;
    margin-right: 150px;
    margin-bottom: 80px;
  }

  .rennweg {
    font-size: 25px;
    padding-top: 1em;
    padding-left: 6em;
    margin-bottom: 80px;
  }
}

// Medium devices (tablets, 768px and up)
@media (min-width: 768px) {

  .tutorlink {
    font-size: 25px;
    padding-left: 6em;
    padding-top: 1em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 25px;
    padding-top: 1em;
    padding-left: 6em;
    margin-bottom: 150px;
  }

}

// Large devices (desktops, 992px and up)
@media (min-width: 992px) {

  .tutorlink {
    font-size: 25px;
    padding-left: 6em;
    padding-top: 1em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 25px;
    padding-top: 1em;
    padding-left: 6em;
    margin-bottom: 150px;
  }

}

// Extra large devices (large desktops, 1200px and up)
@media (min-width: 1200px) {

  .tutorlink {
    font-size: 26px;
    padding-left: 6em;
    padding-top: 1em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 26px;
    padding-top: 1em;
    padding-left: 6em;
    margin-bottom: 150px;
  }
}*/

</style>