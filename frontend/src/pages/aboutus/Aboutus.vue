<template>
  <div>
    <img src="@/assets/images/aboutus.jpg" alt="aboutus" class="crop-center">
    <span class="u1">Über Uns</span>
    <div class="wrapper">
      <div class="el1">
        <span class="u2">Idee</span>
        <img class="icons" src="@/assets/images/idee.png" alt="idee">
        <p class="text">Nachhilfe ist heutzutage an Schulen ein wichtiges Thema, deshalb bieten wir Schüler*innen und Tutoren eine
          schnelle und effiziente Möglichkeit Nachhilfe innerhalb der Schule zu finden. Das Projekt soll die
          Organisation und Vermittlung der Nachhilfe verbessern und eine einfach zu bedienende digitale Alternative
          darstellen. Das Ziel unseres Nachhilfeportals ist, allen Schüler*innen jeglichen Jahrganges eine passende
          Nachhilfe zu finden. Sie haben die Möglichkeit einen passenden Tutor nach Jahrgang und benötigtem Fach
          auszuwählen. Unser Nachhilfeportal ist ein Schulinternes Projekt, bei welchem sich alle
          Schüler*innen der HTL Rennweg mit ihrer Schulemail anmelden können. Jeder User besitzt eine Profilseite, auf
          welcher wichtige Personendaten vorhanden sind: Name, Telefonnummer, E-Mail, persönlicher Stundenplan für die
          Terminplanung.
        </p>
      </div><br>
      <img class="icons1" src="@/assets/images/onedrive.png" alt="onedrive">
      <div class="text1">
        <span class="u2">HTL-Rennweg</span>
        <p>Tutorlink ist ein Projekt der HTL-Rennweg, welches ausschließlich für Schüler*innen dieser Schuleinrichtung
          verwendet werden kann. Das Projekt soll Schüler*innen unserer Schule helfen und diese beim Lernprozess unterstützen.
          Mit der Zusammenarbeit der HTL-Rennweg und der Bildungsberatung kann dies ermöglicht werden und in Zukunft an allen Schulen Wiens verwendet werden.</p>
      </div>
      <img class="team" src="@/assets/images/group.png" alt="team">
    </div>
    <div class="people">
      <div class="oben">
        <img class="people" src="@/assets/images/man.png" alt="man">
        <img class="people" src="@/assets/images/man.png" alt="man"><br>
      </div>
      <div class="unten">
        <img class="people" src="@/assets/images/woman.png" alt="frau">
        <img class="people" src="@/assets/images/man.png" alt="man">
        <img class="people" src="@/assets/images/woman.png" alt="frau">
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "Aboutus"
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
  font-weight: 200;
  font-style: initial;
  font-size: 40px;
  padding-left: 4em;
  letter-spacing: 2.5px;
  color: colors.$fourth;
}

.u2 {
  letter-spacing: 2.5px;
  color: colors.$fourth;
  font-style: initial;
  font-size: 30px;

}

.wrapper {
  padding-left: 300px;
  padding-right: 300px;
}

.el1 {

}

.icons {
  width: 15%;
  float: right;
  padding-right: 15%;
  padding-top: 10%;
}

.icons1{
  width: 15%;
  float: left;
  padding-left: 15%;
  padding-top: 5%;
}

p {
  font-size: 18px;
  line-height: 38px;
}

.text1{
  padding-left: 50%;
}

.text{
  padding-right: 50%;
}

.team{
  width: 210px;
  padding-top: 50px;
  padding-left: 43%;
}

.people{
  width: 210px;
}

.oben{
  padding-left: 50%;
}

</style>