<template>
  <div>
    <img src="@/assets/images/Imprint.png" alt="imprint" class="crop-center">
    <div>
      <p class="u1">Impressum</p>
    </div>
    <div class="tutorlink">
      Tutorlink Project<br>
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
      Schulstandort:<br>
      <a href="https://www.htlrennweg.at/"><img src="@/assets/images/htlw3r_logo.png" alt="htlw3r"><br></a>
      HTL Wien 3 Rennweg<br>
      Rennweg 89B<br>
      1030 Wien<br>
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
  }
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
.u1 {
  font-family: dinosaur, sans-serif;
  font-weight: 200;
  font-style: initial;
  font-size: 55px;
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
img.crop-center{
  height: 250px;
  width: 100% !important;
  object-fit: cover;
  object-position: top center;
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
    font-size: 25px;
    padding-left: 2.5em;
    padding-top: 1.5em;
    margin-bottom: 80px;
  }

  .rennweg {
    font-size: 25px;
    padding-top: 1.5em;
    padding-left: 2.5em;
    letter-spacing: 2.5px;
  }
}

// Small devices (landscape phones, 576px and up)
@media (min-width: 576px) {

  .tutorlink {
    font-size: 28px;
    padding-left: 6em;
    padding-top: 1.5em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 28px;
    padding-top: 1.5em;
    padding-left: 6em;
    margin-bottom: 150px;
  }
}

// Medium devices (tablets, 768px and up)
@media (min-width: 768px) {

  .tutorlink {
    font-size: 28px;
    padding-left: 6em;
    padding-top: 1.5em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 28px;
    padding-top: 1.5em;
    padding-left: 6em;
    margin-bottom: 150px;
  }

}

// Large devices (desktops, 992px and up)
@media (min-width: 992px) {

  .tutorlink {
    font-size: 28px;
    padding-left: 6em;
    padding-top: 1.5em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 28px;
    padding-top: 1.5em;
    padding-left: 6em;
    margin-bottom: 150px;
  }

}

// Extra large devices (large desktops, 1200px and up)
@media (min-width: 1200px) {

  .tutorlink {
    font-size: 28px;
    padding-left: 6em;
    padding-top: 1.5em;
    float: left;
    margin-right: 150px;
    margin-bottom: 150px;
  }

  .rennweg {
    font-size: 28px;
    padding-top: 1.5em;
    padding-left: 6em;
    margin-bottom: 150px;
  }
}

</style>