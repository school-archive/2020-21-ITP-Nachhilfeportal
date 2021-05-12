<template>
  <div>
    <img src="@/assets/images/Imprint.png" alt="imprint" height="300px" width="100%">
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
      <span><font-awesome-icon :icon="faEnvelope"/> tutorlink.project@gmail.com</span><br>
      <span><font-awesome-icon :icon="faPhoneAlt"/> +43 650 9879007</span><br>
      <br>
    </div>
    <div class="rennweg">
      Schulstandort:<br>
      <img src="@/assets/images/htlw3r_logo.png" alt="htlw3r"><br>
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


</style>